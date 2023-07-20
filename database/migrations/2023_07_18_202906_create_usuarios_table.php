<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('usu_id');
            $table->string('usu_nombre', 120);
            $table->string('usu_apellido', 120);
            $table->string('usu_documento', 120);
            $table->string('usu_email', 120);
            $table->string('usu_password', 120);
            $table->unsignedInteger('tid_id');
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('est_id');
            $table->foreign('tid_id')
                ->references('tid_id')
                ->on('tipo_documentos')
                ->onDelete('cascade');

            $table->foreign('rol_id')
                ->references('rol_id')
                ->on('rols')
                ->onDelete('cascade');

            $table->foreign('est_id')
                ->references('est_id')
                ->on('estados')
                ->onDelete('cascade');
        });

        DB::table('usuarios')->insert([
            ['usu_nombre' => 'jhon', 'usu_apellido' => 'doe', 'usu_email'=>'johndoe@example.com', 
            'usu_documento'=> '123456789', 'usu_password' => '123', 'tid_id'=>'1', 'rol_id'=>1, 'est_id'=>1]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};