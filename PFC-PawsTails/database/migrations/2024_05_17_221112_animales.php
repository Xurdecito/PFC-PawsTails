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
        Schema::create("animales", function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->enum("especie", ["perro", "gato"]);
            $table->text("descripcion")->nullable();
            $table->boolean("adoptado")->default(false);
            $table->foreignId("usuario_id")->constrained()->onDelete("cascade");//Para recuperar al refugio que ha agregado al animal
            $table->string("imagen");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("animales");
    }
};
