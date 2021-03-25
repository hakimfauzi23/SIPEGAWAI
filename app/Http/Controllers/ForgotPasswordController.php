<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\SUpport\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ForgotPasswordController extends Controller
{
  public function getEmail()
  {

    return view('password.email');
  }

  public function postEmail(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
    ]);

    $token = Str::random(62);

    DB::table('password_resets')->insert(
      ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
    );

    Mail::send('password.verify', ['token' => $token], function ($message) use ($request) {
      $message->to($request->email);
      $message->subject('Reset Password Notification');
    });

    Alert::success('success', 'link reset anda telah terkirim  apabila email anda terdaftar di database !');
    return redirect('/');
  }
}
