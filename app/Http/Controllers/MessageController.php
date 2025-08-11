<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    function index(){
        return view('messages.index');
    }

    function userSearch(Request $request){
        $getRecords = null;
        $input = $request['query'];
        $records = User::where('id', '!=', Auth::user()->id)
                    ->where('name', 'LIKE',"%{$input}%")
                    ->orWhere('user_name', 'LIKE',"%{$input}%")
                    ->paginate(10);

        if($records->total() < 1) {
            $getRecords = "<p class='text-center'>Nothing to show. </p>";
        }
        foreach($records as $record){
            $getRecords .= view('messages.layouts.search-list', compact('record'))->render();
        }
        return response()->json([
            'records' => $getRecords,
            'last_page' => $records->lastPage()
        ]);
    }
}
