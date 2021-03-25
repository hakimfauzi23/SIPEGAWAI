<?php 

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPasswordController extends Controller { 

  public function getPassword($token) { 

     return view('password.reset', ['token' => $token]);
  }

  public function updatePassword(Request $request)
  {

  $request->validate([
      'email' => 'required|email|exists:pegawai',
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required',

  ]);

  $updatePassword = DB::table('password_resets')
                      ->where(['email' => $request->email, 'token' => $request->token])
                      ->first();

  if(!$updatePassword)
      return back()->withInput()->with('error', 'Invalid token!');

    $user = Pegawai::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

    DB::table('password_resets')->where(['email'=> $request->email])->delete();

    Alert::success('success', 'Password Anda Berhasil Di Reset!');
    return redirect('/');

  }
}