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
        Schema::create("adopciones", function (Blueprint $table) {
            $table->id();
            $table->foreignId("usuario_id")->constrained()->onDelete("cascade");
            $table->foreignId("animale_id")->constrained()->onDelete("cascade");//Le pongo la e ya que laravel lo pone en plural de ingles, y si no iria a la tabla de animals
            $table->foreignId("refugio_id")->constrained("usuarios")->onDelete("cascade");//Para recuperar al refugio que ha agregado al animal
            $table->enum("estado", ["pendiente", "aprobado", "rechazado"])->default("pendiente");
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("adopciones");
    }
};
