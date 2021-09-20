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
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proposal_id');
            $table->string('dokumen', 150);
            $table->unsignedBigInteger('pendaftaran_id');
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
