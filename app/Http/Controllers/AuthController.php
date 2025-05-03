<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'confirm' => 'required|same:password',
        ]);

        $data = [
            'username' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
        ];

        Customer::create($data);
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = Customer::where('username', $request->input('name'))->first();

        if(!$user || !Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('login')->with('error', 'Username dan password tidak sesuai!');
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout() 
    {
        Session::forget('cart'); 
        Auth::logout();
        return redirect()->route('login');
    }
}
