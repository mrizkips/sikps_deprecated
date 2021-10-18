<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFormPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_penilaian', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->smallIncrements('id');
            $table->string('nama', 100);
            $table->enum('jenis', ['1','2','3'])->comment('1 => Sidang Skripsi, 2 => Pra-Sidang Skripsi, 3 => Kerja Praktek');
            $table->enum('penilai', ['1','2','3','4'])->comment('1 => Prodi, 2 => Penguji 1, 3 => Penguji 2, 4 => Pembimbing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_penilaian');
    }
}
