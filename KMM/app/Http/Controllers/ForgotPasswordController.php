<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
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

    $pegawai = Pegawai::where('email', '=', $request->email)->first();
    // dd($pegawai);
    if ($pegawai === null) {
      Alert::error('error', 'Email Tidak Terdaftar !');
      return redirect('/forget-password');
    } else {
      $token = Str::random(62);

      DB::table('password_resets')->insert(
        ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
      );

      Mail::send('password.verify', ['token' => $token], function ($message) use ($request) {
        $message->to($request->email);
        $message->subject('Reset Password Notification');
      });

      Alert::success('success', 'Link Reset Password Terkirim Di Email Anda !');
      return redirect('/login');
    }
  }
}
