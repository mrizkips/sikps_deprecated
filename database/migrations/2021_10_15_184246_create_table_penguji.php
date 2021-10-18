<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenguji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguji', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('pengujian_id');
            $table->enum('role', ['1','2'])->comment('1 => Penguji 1, 2 => Penguji 2');
            $table->timestamps();

            $table->foreign('dosen_id')
                ->references('id')->on('dosen')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('pengujian_id')
                ->references('id')->on('pengujian')
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
        Schema::dropIfExists('penguji');
    }
}
