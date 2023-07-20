<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_comercios', function (Blueprint $table) {
            $table->increments('tic_id');
            $table->string('tic_name', 120);
        });

        DB::table('tipo_comercios')->insert([
            ['tic_name' => 'alimentos'],
            ['tic_name' => 'ropas y textiles'],
            ['tic_name' => 'deportes']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_comercios');
    }
};
