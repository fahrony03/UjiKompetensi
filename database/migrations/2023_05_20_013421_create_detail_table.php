<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('id_artikel', false, true);
            $table->integer('id_komentar', false, true);
            
            $table->foreign('id_artikel')->references('id')->on('artikel')->cascadeOnDelete();
            $table->foreign('id_komentar')->references('id')->on('komentar')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail');
    }
}
