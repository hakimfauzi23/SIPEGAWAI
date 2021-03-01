<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_jabatan');
            $table->year('tgl_mulai');
            $table->timestamps();

            $table->index('id_pegawai');
            $table->index('id_jabatan');
            $table->foreign('id_pegawai')->references('id')->on('pegawai');
            $table->foreign('id_jabatan')->references('id')->on('jabatan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_jabatan');
    }
}
