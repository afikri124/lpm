<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateObservationCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observation_criterias', function (Blueprint $table) {
            //
            $table->decimal('weight');
            $table->foreignId('observation_category_id')->constrained('observation_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observation_criterias', function (Blueprint $table) {
            //
            $table->dropColumn('weight');
            $table->dropColumn('observation_category_id');
        });
    }
}
