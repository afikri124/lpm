<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observations', function (Blueprint $table) {
            //
            $table->string('subject_course')->nullable();
            $table->string('topic')->nullable();
            $table->string('class_type')->nullable();
            $table->string('location')->nullable();
            $table->string('study_program')->nullable();
            $table->string('total_students')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observations', function (Blueprint $table) {
            //
            $table->dropColumn('gender');
            $table->dropColumn('topic');
            $table->dropColumn('class_type');
            $table->dropColumn('location');
            $table->dropColumn('study_program');
            $table->dropColumn('total_students');
        });
    }
}
