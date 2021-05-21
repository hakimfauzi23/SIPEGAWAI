<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->date('tanggal');
            $table->integer('gaji_pokok')->unsigned()->nullable();
            $table->integer('jml_tunjangan')->unsigned()->nullable();
            $table->integer('jml_potongan')->unsigned()->nullable();
            $table->integer('tot_gaji_diterima')->unsigned()->nullable();
            $table->date('dikirim_tgl')->nullable();
            $table->boolean('is_sent')->nullable()->default(false);
            $table->text('path');
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
        Schema::dropIfExists('gaji');
    }
}
