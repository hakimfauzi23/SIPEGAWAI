<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPasswordController extends Controller
{

  public function getPassword($token)
  {

    return view('password.reset', ['token' => $token]);
  }

  public function updatePassword(Request $request)
  {

    // dd($request->token);

    //Cek Validasi Token 
    $token = DB::table('password_resets')
      ->where(['email' => $request->email, 'token' => $request->token])
      ->where('created_at', '>', Carbon::now()->subHours(12))
      ->first();

    // dd($token);
    if ($token == null) {
      Alert::error('error', 'Token Invalid / Kadaluarsa!');
      return redirect('/login');
    } else {
      $request->validate([
        'email' => 'required|email|exists:pegawai',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required',

      ]);

      $user = Pegawai::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

      DB::table('password_resets')->where(['email' => $request->email])->delete();

      Alert::success('success', 'Password Anda Berhasil Di Reset!');
      return redirect('/login');
    }
  }
}
