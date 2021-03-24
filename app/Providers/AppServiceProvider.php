<?php

namespace App\Providers;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();

        $jml_cuti = Cuti::where('status', 'Disetujui Atasan')->count();
        View::share('jml_cuti', $jml_cuti);

        view()->composer('*', function ($view) {

            if (Auth::check()) {
                $bawahan = Pegawai::where('id_atasan', Auth::user()->id)->get();
                $id_bawahan = $bawahan->pluck('id');

                $pengajuan_cuti_bawahan = Cuti::whereIn('id_pegawai', $id_bawahan)
                    ->where('status', 'Diproses')
                    ->get();
                $jml_pengajuan_cuti_bawahan = $pengajuan_cuti_bawahan->count();
                $jml_bawahan = $bawahan->count();
                $view->with('jml_bawahan', $jml_bawahan);
                $view->with('jml_pengajuan_cuti_bawahan', $jml_pengajuan_cuti_bawahan);
            } else {
                $view->with('jml_bawahan', null);
                $view->with('jml_pengajuan_cuti_bawahan', null);
            }
        });
    }
}
