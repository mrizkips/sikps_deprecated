<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSidang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidang', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->enum('jenis', ['1','2','3'])->comment('1 => Sidang Skripsi, 2 => Pra-Sidang Skripsi, 3 => Sidang KP');
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('pendaftaran_id');
            $table->string('laporan', 150);
            $table->string('penilaian_kp', 150)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('proposal_id')
                ->references('id')->on('proposal')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('pendaftaran_id')
                ->references('id')->on('pendaftaran')
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
        Schema::dropIfExists('sidang');
    }
}
