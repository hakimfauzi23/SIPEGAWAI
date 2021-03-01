<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_role');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jk', ['Pria', 'Wanita']);
            $table->string('agama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('alamat_ktp');
            $table->string('alamat_dom');
            $table->enum('status', ['Menikah', 'Lajang']);
            $table->integer('jml_anak');
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->text('password');
            $table->date('tgl_masuk');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_divisi');
            $table->string('path');
            $table->timestamps();

            $table->index('id_jabatan');
            $table->index('id_divisi');
            $table->index('id_role');
            $table->foreign('id_jabatan')->references('id')->on('jabatan');
            $table->foreign('id_divisi')->references('id')->on('divisi');
            $table->foreign('id_role')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
