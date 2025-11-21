<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('development_plans', function (Blueprint $table) {
            $table->id();
            $table->string('year', 20); // Tahun akademik: '2020/2021', '2021/2022', dll
            $table->string('priority', 100); // Prioritas: 'Jumlah Mahasiswa', 'Kualitas Pendidikan', dll
            $table->text('uraian'); // Deskripsi indikator
            $table->string('rencana', 255)->nullable(); // Bisa numeric atau string (untuk dropdown)
            $table->decimal('tercapai', 10, 2)->nullable(); // Target tercapai (numeric)
            $table->string('link', 500)->nullable(); // Link untuk eviden
            $table->boolean('is_numeric')->default(true); // Apakah rencana numeric atau tidak
            $table->integer('sort_order')->default(0); // Urutan dalam prioritas
            $table->timestamps();
            
            // Index untuk performa query
            $table->index('year');
            $table->index('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('development_plans');
    }
}
