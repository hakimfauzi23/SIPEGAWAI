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
            $table->enum('tipe_cuti', ['Tahunan', 'Besar', 'Bersama', 'Hamil', 'Sakit', 'Penting']);
            $table->date('tgl_pengajuan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->text('ket');
            $table->enum('status', ['Disetujui HRD', 'Ditolak HRD', 'Disetujui Atasan', 'Ditolak Atasan', 'Diproses']);
            $table->date('tgl_disetujui_atasan')->nullable();
            $table->date('tgl_disetujui_hrd')->nullable();
            $table->date('tgl_ditolak_atasan')->nullable();
            $table->date('tgl_ditolak_hrd')->nullable();
            $table->timestamps();

            $table->index('id_pegawai');
            $table->foreign('id_pegawai')
                ->references('id')
                ->on('pegawai')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
