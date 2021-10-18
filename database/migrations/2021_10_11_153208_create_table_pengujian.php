<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePengujian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengujian', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pendaftaran_id');
            $table->unsignedBigInteger('sidang_id');
            $table->date('tanggal');
            $table->time('mulai');
            $table->time('selesai');
            $table->string('ruangan');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('pendaftaran_id')
                ->references('id')->on('pendaftaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sidang_id')
                ->references('id')->on('sidang')
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
        Schema::dropIfExists('pengujian');
    }
}
