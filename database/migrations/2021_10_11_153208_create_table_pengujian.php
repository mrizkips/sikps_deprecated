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
            $table->unsignedBigInteger('jadwal_sidang_id');
            $table->unsignedBigInteger('sidang_id');
            $table->unsignedBigInteger('dosen_id');
            $table->integer('nilai_ppt')->nullable();
            $table->integer('nilai_laporan')->nullable();
            $table->integer('nilai_aplikasi')->nullable();
            $table->timestamps();

            $table->foreign('jadwal_sidang_id')
                ->references('id')->on('jadwal_sidang')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sidang_id')
                ->references('id')->on('sidang')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('pengujian');
    }
}
