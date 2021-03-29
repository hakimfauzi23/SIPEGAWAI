<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeraturansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidphp 
     */
    public function up()
    {
        Schema::create('peraturan', function (Blueprint $table) {
            $table->id();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_plg')->nullable();
            $table->integer('jml_cuti_tahunan')->unsigned()->nullable()->default(12);
            $table->integer('jml_cuti_besar')->unsigned()->nullable()->default(12);
            $table->integer('jml_cuti_bersama')->unsigned()->nullable()->default(12);
            $table->integer('jml_cuti_hamil')->unsigned()->nullable()->default(12);
            $table->integer('jml_cuti_sakit')->unsigned()->nullable()->default(12);
            $table->integer('jml_cuti_penting')->unsigned()->nullable()->default(12);
            $table->integer('syarat_bulan_cuti_tahunan')->unsigned()->nullable()->default(0);
            $table->integer('syarat_bulan_cuti_besar')->unsigned()->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peraturan');
    }
}
