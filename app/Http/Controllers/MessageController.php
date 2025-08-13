<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use FileUploadTrait;
    function index()
    {
        return view('messages.index');
    }

    function userSearch(Request $request)
    {
        $getRecords = null;
        $input = $request['query'];
        $records = User::where('id', '!=', Auth::user()->id)
            ->where('name', 'LIKE', "%{$input}%")
            ->orWhere('user_name', 'LIKE', "%{$input}%")
            ->paginate(10);
        if ($records->total() < 1) {
            $getRecords = "<p class='text-center'>Nothing to show. </p>";
        }
        foreach ($records as $record) {
            $getRecords .= view('messages.layouts.search-list', compact('record'))->render();
        }
        return response()->json([
            'records' => $getRecords,
            'last_page' => $records->lastPage()
        ]);
    }

    function getUser(Request $request)
    {
        $user = User::find($request['id']);
        return response()->json($user);
    }

    function sendMessage(Request $request)
    {
        $request->validate([
            'message' => ['required'],
            'id' => ['required', 'integer'],
            'temporaryMsgId' => ['required'],
            'attachment' => ['nullable', 'image', 'max:2048']
        ]);
        
        $attachmentPath = $this->uploadFile($request, 'attachment');

        $message = new Message();
        $message->form_id = Auth::user()->id;
        $message->to_id = $request['id'];
        $message->body = $request['message'];
        if ($attachmentPath) $message->attachment = json_encode($attachmentPath);
        $message->save();

        return response()->json([
            'message' => $this->messageCard($message),
            'tempID' => $request->temporaryMsgId
        ]);
    }

    function messageCard($message)
    {
        return view('messages.layouts.message-card', compact('message'))->render();
    }
}
