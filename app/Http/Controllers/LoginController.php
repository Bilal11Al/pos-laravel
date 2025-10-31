<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Alert;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }
    public function actionLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        Alert::warning('Ups', 'Invalid Login');
        return back()->withInput($request->only('email'));
        // alert()->warning('Title', 'Lorem Lorem Lorem');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
