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
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('est_id');
            $table->string('est_name', 120);
        });
        DB::table('estados')->insert([
            ['est_name' => 'activo'],
            ['est_name' => 'inactivo'],
            ['est_name' => 'en deuda'],
            ['est_name' => 'desalojo'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
