<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginform($type)
    {
        return view('auth.login', compact('type'));
    }


    public function login(Request $request)
    {


        $guardname = 'web';
        if ($request->type == 'student') {
            $guardname = 'student';
        } elseif ($request->type == 'teacher') {
            $guardname = 'teacher';
        } elseif ($request->type == 'parent') {
            $guardname = 'parent';
        } else {
            $guardname = 'web';
        }



        if (Auth::guard($guardname)->attempt(['email' => $request->email, 'password' => $request->password])) {

            if ($request->type == 'student') {
                return redirect()->intended(RouteServiceProvider::STUDENT);
            } elseif ($request->type == 'parent') {
                return redirect()->intended(RouteServiceProvider::PARENT);
            } elseif ($request->type == 'teacher') {
                return redirect()->intended(RouteServiceProvider::TEACHER);
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
    }
}
