<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatDivisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_divisi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_divisi');
            $table->date('tgl_mulai');
            $table->timestamps();

            $table->index('id_pegawai');
            $table->index('id_divisi');
            $table->foreign('id_pegawai')
                ->references('id')
                ->on('pegawai')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_divisi')
                ->references('id')
                ->on('divisi')
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
        Schema::dropIfExists('riwayat_divisi');
    }
}
