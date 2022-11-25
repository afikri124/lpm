<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqToObservationCriteriaTable extends Migration
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
            $table->unique(['observation_id','criteria_id'],'unique_oid_cid');
        });

        Schema::table('observation_categories', function (Blueprint $table) {
            //
            $table->unique(['observation_id','criteria_category_id'],'unique_oid_ccid');
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
