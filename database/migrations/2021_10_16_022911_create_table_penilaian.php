<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('sidang_id');
            $table->unsignedSmallInteger('form_penilaian_id');
            $table->timestamps();

            $table->foreign('dosen_id')
                ->references('id')->on('dosen')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sidang_id')
                ->references('id')->on('sidang')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('form_penilaian_id')
                ->references('id')->on('form_penilaian')
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
        Schema::dropIfExists('penilaian');
    }
}
