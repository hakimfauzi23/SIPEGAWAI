<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('login.index');
    }
    public function proses_login(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role->nm_role == 'superAdmin') {
                return redirect()->intended('superAdmin');
            } elseif ($user->role->nm_role == 'hrd') {
                return redirect()->intended('hrd');
            } elseif ($user->role->nm_role == 'staff') {
                return redirect()->intended('staff');
            }
        } else {
            Alert::error('error', 'Ups!! Password / Username Kamu Salah!!');
            return redirect('/login');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
