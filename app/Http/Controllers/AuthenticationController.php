<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Validations;


class AuthenticationController extends Controller
{
    public function registration()
    {
        return view('auth.registartion');
    }


    public function registr(Validations $request)
    {
        $validated = $request->validated();

        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->input('password'));
        $user->user_name = $request->user_name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->Birth = $request->Birth;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;

        }
        $res = $user->save();




        if ($res) {
            $message = __('messages.user_registered_successfully');
            Mail::to(env('MAIL_USERNAME'))->send(new UserRegistered($user));
            return response()->json(['success' => true, 'message' => $message]);
        } else {
            $message = __('messages.something_went_wrong');
            return response()->json(['success' => false, 'errors' => ['server' => $message]], 422);
        }

    }

}







