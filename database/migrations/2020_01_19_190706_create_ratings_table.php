<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('discipline');
            $table->unsignedTinyInteger('teamwork');
            $table->unsignedTinyInteger('speed');
            $table->unsignedTinyInteger('skill');
            $table->unsignedTinyInteger('accuracy');
            $table->float('summary', 4, 2);
            $table->timestamps();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
