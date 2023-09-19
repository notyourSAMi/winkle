<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function login()
    {
        return view("login");
    }
    public function registration()
    {
        return view("signup");
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (session()->has('user_data')) {
                session(['user_data' => null]);
                session()->save(); 
    
            }
            return redirect()->intended(url('/'))->with("success", "Login Successfully");
        } else {
            return redirect(route('Login'))->with("error", "Login Details are not valid");
        }
    }
    public function RegistrationPost(Request $request)
    {
 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect(route('Registration'))->with("error", "Registration failed, try again.");
        } else {

            return redirect(route('Login'))->with("success", "Registration Successfully");
        }
    

    }
    public function logout()
    {
        if (Auth::check()) {
            $userData = [
                "user_id" => Auth::user()->id,
            ];
            session(['user_data' => $userData]);
            Auth::logout();
        }
    
        return redirect(route('Login'));
    }

}