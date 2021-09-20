<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('judul', 150);
            $table->enum('jenis', ['Skripsi', 'Kerja Praktek']);
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('dokumen', 150);
            $table->unsignedBigInteger('pendaftaran_id');
            $table->unsignedSmallInteger('kbb_id');
            $table->date('tanggal_kontrak');
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')
                ->references('id')->on('mahasiswa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('pendaftaran_id')
                ->references('id')->on('pendaftaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kbb_id')
                ->references('id')->on('kbb')
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
        Schema::dropIfExists('proposal');
    }
}
