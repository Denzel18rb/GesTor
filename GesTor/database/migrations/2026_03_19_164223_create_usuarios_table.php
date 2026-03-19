<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->integer('edad')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 150)->unique();
            $table->string('password');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->enum('estado', ['Pendiente', 'En Proceso','Terminado'])->default('En Proceso');
            $table->timestamps();
        });
    }
};
