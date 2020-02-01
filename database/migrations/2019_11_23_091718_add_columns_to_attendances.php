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
            $table->boolean('duplicated');
            $table->boolean('show_in_current_date');
            $table->unsignedTinyInteger('evaluation');
            $table->unsignedTinyInteger('additional_type');
            $table->time('boundary');
            $table->unsignedInteger('additional_minutes')
                ->nullable();
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
                'recorded_time',
                'duplicated',
                'show_in_current_date',
                'evaluation',
                'additional_type',
                'boundary',
                'additional_minutes',
            ]);
        });
    }
}
