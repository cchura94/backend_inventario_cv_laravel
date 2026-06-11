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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->dateTime("fecha");
            $table->string("tipo_nota");
            $table->boolean("estado")->default(true);
            $table->text("observaciones")->nullable();

            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("clienteproveedor_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("clienteproveedor_id")->references("id")->on("users");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
