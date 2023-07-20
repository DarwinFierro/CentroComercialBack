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
        Schema::create('rols', function (Blueprint $table) {
            $table->increments('rol_id');
            $table->string('rol_name',120);
        });

        DB::table('rols')->insert([
            ['rol_name' => 'SUPER_OWNER'],
            ['rol_name' => 'LOCAL_OWNER'],
            ['rol_name' => 'en WATCHMAN'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rols');
    }
};
