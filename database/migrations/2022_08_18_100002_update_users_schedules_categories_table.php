<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersSchedulesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('front_title')->nullable();
            $table->string('back_title')->nullable();
        });

        Schema::table('criteria_categories', function (Blueprint $table) {
            $table->boolean('is_required')->default(false);
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->string('study_program')->nullable();
        });

        Schema::table('observations', function (Blueprint $table) {
            $table->dropColumn('study_program');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('front_title');
            $table->dropColumn('back_title');
        });

        Schema::table('criteria_categories', function (Blueprint $table) {
            $table->dropColumn('is_required');
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('study_program');
        });

        Schema::table('observations', function (Blueprint $table) {
            $table->string('study_program')->nullable();
        });
    }
}
