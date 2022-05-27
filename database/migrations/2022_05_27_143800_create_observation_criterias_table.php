<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_criterias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('observation_id')->constrained('observations')->onDelete('cascade');

            $table->unsignedBigInteger('criteria_id')->nullable();
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('set null');

            $table->bigInteger('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observation_criterias');
    }
}
