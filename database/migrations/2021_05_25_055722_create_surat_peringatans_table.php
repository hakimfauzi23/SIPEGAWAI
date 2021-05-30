<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPeringatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_peringatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pegawai');
            $table->date('tanggal');
            $table->enum('tingkat', ['I', 'II', 'III'])->nullable();
            $table->json('pelanggaran')->nullable();
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
        Schema::dropIfExists('surat_peringatan');
    }
}
