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
            $table->unsignedBigInteger('id_role')->nullable();
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
            $table->unsignedBigInteger('id_atasan')->nullable();
            $table->unsignedBigInteger('id_jabatan')->nullable();
            $table->unsignedBigInteger('id_divisi')->nullable();
            $table->string('path');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index('id_jabatan');
            $table->index('id_divisi');
            $table->index('id_role');
            $table->foreign('id_jabatan')
                ->references('id')
                ->on('jabatan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('id_divisi')
                ->references('id')
                ->on('divisi')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('id_role')
                ->references('id')
                ->on('roles')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('id_atasan')
                ->references('id')
                ->on('pegawai')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');
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
