<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAttendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('recorded_at');
            $table->time('recorded_time');
            $table->unsignedTinyInteger('type');
            $table->unsignedTinyInteger('days_number_in_month');
            $table->unsignedInteger('additional_duration')->nullable();
            $table->unsignedInteger('additional_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn([
                'employee_id',
                'recorded_at',
                'type',
                'days_number_in_month',
                'additional_duration',
                'additional_type',
            ]);
        });
    }
}
