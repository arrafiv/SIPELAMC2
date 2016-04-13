<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKeluhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->increments('id_keluhan');
            $table->string('username')->references('username')->on('users');
            $table->string('prioritas');
            $table->string('divisi');
            $table->string('status', 20);
            $table->timestamps('waktu_pengajuan');
            $table->text('keluhan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('keluhans');
    }
}
