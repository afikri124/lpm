<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCriteriaNCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('criteria_categories', function (Blueprint $table) {
            //
            $table->boolean('status')->nullable()->default(true);
        });

        Schema::table('criterias', function (Blueprint $table) {
            //
            $table->boolean('status')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('criteria_categories', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });

        Schema::table('criterias', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
}
