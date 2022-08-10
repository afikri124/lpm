<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRemarkAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observations', function (Blueprint $table) {
            $table->text('remark')->nullable()->change();
        });
        Schema::table('schedules', function (Blueprint $table) {
            $table->text('remark')->nullable()->change();
        });
        Schema::table('observation_categories', function (Blueprint $table) {
            $table->text('remark')->nullable()->change();
        });
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->text('remark')->nullable()->change();
        });
        Schema::table('schedule_histories', function (Blueprint $table) {
            $table->text('remark')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
