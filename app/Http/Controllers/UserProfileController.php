<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flasher\Notyf\Prime\NotyfInterface;

class UserProfileController extends Controller
{
    use FileUploadTrait;
    function update(UserProfileRequest $request){
        $avatarPath = $this->uploadFile($request, 'avatar');

        $user = Auth::user();
        if($avatarPath){
            $user->avatar = $avatarPath;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        if(!is_null($request->current_password)){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        notyf('Your profile has been updated.');
        return response(['message', 'Updated Successfully'], 200);
    }
}
