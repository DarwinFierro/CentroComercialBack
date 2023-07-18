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
        Schema::create('locals', function (Blueprint $table) {
            $table->increments('loc_id');
            $table->string('loc_nombre', 120);
            $table->integer('loc_telefono');
            $table->unsignedInteger('usu_id');
            $table->unsignedInteger('est_id');
            $table->unsignedInteger('com_id');
            $table->foreign('usu_id')
                ->references('usu_id')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('est_id')
                ->references('est_id')
                ->on('estados')
                ->onDelete('cascade');

            $table->foreign('com_id')
                ->references('com_id')
                ->on('comercios')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locals');
    }
};
