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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string("nombres", 100);
            $table->string("apelldos", 100);
            $table->date('fecha_nacimiento');
            $table->string("genero", 20);
            $table->text("direccion");

            $table->string("telefono", 20);
            $table->string("nacionalidad", 50);

            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
