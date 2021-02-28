<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAksesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_menu');
            $table->enum('is_aktif', ['true', 'false']);
            $table->timestamps();


            $table->index('id_role');
            $table->index('id_menu');
            $table->foreign('id_role')->references('id')->on('role')->onDelete('cascade');
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akses');
    }
}
