<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // For user registration
    public function register(Request $request)
    {
        // Fields Validation
        $attrs=$request->validate([
            'name'=>'required|string',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        // create users
        $user= User::create(
            [
                'name'=>$attrs['name'],
                'email'=>$attrs['email'],
                'password'=>bcrypt($attrs['password']) 
            ]
        );
        // Token return
        return response(
            [
                'user'=>$user,
                'token'=>$user->createToken('secret')->plainTextToken
            ]
        );
    }


    // For user login
    public function login(Request $request)
    {
        // Fields Validation
        $attrs=$request->validate([
            'email'=>'required',
            'password'=>'required|min:6',
        ]);

        // Login Attempt
        if (!Auth::attempt($attrs)) 
        {
            return response([
                    'message'=>'Invalid  credentials.'
                ],403);
        }
        // Token return
        return response(
            [
                'user'=>auth()->user(),
                'token'=>auth()->user()->createToken('secret') ->plainTextToken
            ],200);
    }


    // For user logout

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response(
            [
                'message'=>'Logout success.'
            ],200 );
    }

    // For user details

    public function user()
    {
        return response(
            [
                'user'=>auth()->user()
            ],200);
    }


}
