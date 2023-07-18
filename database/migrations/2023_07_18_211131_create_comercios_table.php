<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comercios');
    }
};
