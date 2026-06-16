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
        Schema::create('clienteproveedors', function (Blueprint $table) {
            $table->id();
            $table->string("tipo"); // Cliente ,  Proveedor
            $table->string("razon_social", 200);
            $table->string("nro_identificacion", 100)->nullable();
            $table->string("telefono", 20);
            $table->text("direccion")->nullable();
            $table->string("correo", 200);
            $table->boolean("estado");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clienteproveedors');
    }
};
