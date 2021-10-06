<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBimbingan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dosen_id');
            $table->date('tanggal');
            $table->time('mulai');
            $table->time('selesai');
            $table->string('pin', 6);
            $table->string('link', 200)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('dosen_id')
                ->references('id')->on('dosen')
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
        Schema::dropIfExists('bimbingan');
    }
}
