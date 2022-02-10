<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFormPenilaianItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_penilaian_item', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('form_penilaian_id');
            $table->string('nama', 60);
            $table->smallInteger('min')->nullable();
            $table->smallInteger('max')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('form_penilaian_item');
    }
}
