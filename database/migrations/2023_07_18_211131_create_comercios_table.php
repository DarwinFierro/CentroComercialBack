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
        Schema::create('comercios', function (Blueprint $table) {
            $table->increments('com_id');
            $table->string('com_nombre', 120);
            $table->unsignedInteger('tic_id');
            $table->foreign('tic_id')
                ->references('tic_id')
                ->on('tipo_comercios')
                ->onDelete('cascade');
        });

        DB::table('comercios')->insert([
            ['com_nombre' => 'frutas', 'tic_id' => 1],
            ['com_nombre' => 'verduras', 'tic_id' => 1],
            ['com_nombre' => 'granos', 'tic_id' => 1],
            ['com_nombre' => 'hombre', 'tic_id' => 2],
            ['com_nombre' => 'mujer', 'tic_id' => 2],
            ['com_nombre' => 'niño', 'tic_id' => 2],
            ['com_nombre' => 'mixto', 'tic_id' => 2],
            ['com_nombre' => 'futbol', 'tic_id' => 3],
            ['com_nombre' => 'baloncesto', 'tic_id' => 3],
            ['com_nombre' => 'voleibol', 'tic_id' => 3],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comercios');
    }
};
