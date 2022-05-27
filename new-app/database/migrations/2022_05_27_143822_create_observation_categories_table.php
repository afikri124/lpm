<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('observation_id')
            ->constrained('observations')->onDelete('cascade');

            $table->uuid('criteria_category_id')->nullable();
            $table->foreign('criteria_category_id')->references('id')->on('Criteria_categories')->onUpdate('cascade')->onDelete('set null');

            $table->string('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observation_categories');
    }
}
