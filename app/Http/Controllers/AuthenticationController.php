<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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
        $res = $user->save();

        if ($res) {
            return redirect()->back()->with('success', 'User registered successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, try again later.');
        }
    }

}
