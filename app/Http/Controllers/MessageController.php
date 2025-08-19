<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    function getMessages(Request $request)
    {
        $messages = Message::where('to_id', Auth::user()->id)
            ->where('form_id', $request['id'])
            ->orWhere('to_id', $request['id'])
            ->Where('form_id', Auth::user()->id)
            ->latest()
            ->paginate(20);

        $response = [
            'last_page' => $messages->lastPage(),
            'last_message' => $messages->last(),
            'messages' => '',
        ];

        if (count($messages) < 1) {
            $response['messages'] = "<div class='d-flex justify-content-center align-items-center h-100'><p>Say something... </p></div>";
            return response()->json($response);
        }

        $allMessages = '';
        foreach ($messages->reverse() as $message) {
            $allMessages .= $this->messageCard($message);
        }

        $response['messages'] = $allMessages;

        return response()->json($response);
    }

    function messageCard($message)
    {
        return view('messages.layouts.message-card', compact('message'))->render();
    }

    function getContact()
    {
        $users = Message::join('users', function ($join) {
            $join->on('messages.form_id', '=', 'users.id')
                ->orOn('messages.to_id', '=', 'users.id');
        })
            ->where(function ($q) {
                $q->where('messages.form_id', Auth::user()->id)
                    ->orWhere('messages.to_id', Auth::user()->id);
            })
            ->where('users.id', '!=', Auth::user()->id)
            ->select('users.*', DB::raw('MAX(messages.created_at) as max_created_at'))
            ->orderBy('max_created_at', 'desc')
            ->groupBy('users.id')
            ->paginate(10);

        $contacts = '';
        if (count($users) > 0) {
            foreach ($users as $user) {
                $contacts .= $this->getContactItem($user);
            }
        } else {
            $contacts .= "<p>No contacts found</p>";
        }

        return response()->json([
            'contacts' => $contacts,
            'last_page' => $users->lastPage()
        ]);
    }

    function getContactItem($user)
    {
        $lastMessage = Message::where('to_id', Auth::user()->id)
            ->where('form_id', $user->id)
            ->orWhere('to_id', $user->id)
            ->Where('form_id', Auth::user()->id)
            ->latest()->first();

        $unseenCounter = Message::where('to_id', Auth::user()->id)
            ->where('form_id', $user->id)
            ->where('seen', 0)
            ->count();
        return view('messages.layouts.contact', compact('lastMessage', 'unseenCounter', 'user'))->render();
    }

    function updateContact(Request $request)
    {
        $user = User::find($request['user_id']);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        $contactItem = $this->getContactItem($user);
        return response()->json([
            'contact_item' => $contactItem
        ]);
    }
}
