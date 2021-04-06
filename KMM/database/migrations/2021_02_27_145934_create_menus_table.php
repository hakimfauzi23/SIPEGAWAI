<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('urutan_menu');
            $table->string('nm_menu');
            $table->string('class_menu');
            $table->string('url_menu');
            $table->string('icon');
            $table->unsignedBigInteger('id_group');
            $table->timestamps();

            $table->index('id_group');
            $table->foreign('id_group')
                ->references('id')
                ->on('group_menu')
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
        Schema::dropIfExists('menu');
    }
}
