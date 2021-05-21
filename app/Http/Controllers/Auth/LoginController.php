<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login.index');
    }
    protected function authenticated(Request $request, $user)
    {
        //
        if ($user->hasRole('ADMIN')) {
            return redirect()->route('superAdmin.index');
        } else if ($user->hasRole('HRD')) {
            return redirect()->route('hrd.index');
        }

        return redirect()->route('staff.index');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        Alert::error('error', 'Ups!! Password / Username Kamu Salah!!');
        return redirect('/login');
}

}
