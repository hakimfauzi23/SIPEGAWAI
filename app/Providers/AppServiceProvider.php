<?php

namespace App\Providers;

use App\Models\Cuti;
use Illuminate\Pagination\Paginator;
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

        $jml_cuti = Cuti::where('status','Disetujui Atasan')->count();
        View::share('jml_cuti', $jml_cuti);
    }
}
