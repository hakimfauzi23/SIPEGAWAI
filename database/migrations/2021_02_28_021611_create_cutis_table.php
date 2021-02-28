<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->enum('tipe_cuti', ['tahunan', 'besar', 'bersama', 'hamil', 'sakit', 'penting']);
            $table->date('tgl_pengajuan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->text('ket');
            $table->enum('status', ['disetujui', 'ditolak', 'diproses']);
            $table->date('tgl_disetujui')->nullable();
            $table->date('tgl_ditolak')->nullable();
            $table->timestamps();

            $table->index('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuti');
    }
}
