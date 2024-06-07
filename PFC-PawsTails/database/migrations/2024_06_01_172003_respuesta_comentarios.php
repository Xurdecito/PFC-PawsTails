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
        Schema::create("respuestaComentarios", function (Blueprint $table) {
            $table->id();
            $table->foreignId("comentario_id")->constrained()->onDelete("cascade");
            $table->foreignId("usuario_id")->constrained()->onDelete("cascade");
            $table->foreignId("producto_id")->constrained()->onDelete("cascade");//Le paso el id del producto para que no se devuelvan todos los comentarios cada vez que se cargue una de las pestañas de los productos
            $table->string("mensaje",255);
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("respuestaComentarios");
    }
};
