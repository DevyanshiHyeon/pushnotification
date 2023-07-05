<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|min:3'
        ]);

        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($user_data)) {
            return redirect('/dashboard');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
