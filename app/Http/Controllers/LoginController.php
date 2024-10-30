<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(LoginFormRequest $request)
    {
        $user = $request->validated();
        if(Auth::attempt($user, $request->only('remember') == 'on')) {

            $request->session()->regenerate();

            return redirect()->intended('/admin')->with('success', 'Logged in successfully!');

        }
        return back()->withErrors(['email' => 'The provided credentials do not persist in database']);

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
