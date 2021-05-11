<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();

        dd('im here');
        if ($user->role->nm_role == $roles)
            return $next($request);

        Alert::error('error', 'Ups!! Kamu tidak Punya Akses!!');
        return redirect('/login');
    }
}
