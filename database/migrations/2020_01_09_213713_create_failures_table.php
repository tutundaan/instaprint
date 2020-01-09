<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')
                  ->unique();
            $table->string('holder');
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('discount');
            $table->unsignedInteger('tax');
            $table->unsignedInteger('freight');
            $table->unsignedInteger('total');
            $table->unsignedInteger('paid');
            $table->string('signed');
            $table->unsignedTinyInteger('rating');
            $table->string('note');
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
        Schema::dropIfExists('failures');
    }
}
