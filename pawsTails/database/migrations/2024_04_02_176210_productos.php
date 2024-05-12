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
        Schema::create("productos", function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("descripcion",255);
            $table->foreignId("categoria_id")->constrained();//Al usar la funcion constrained, laravel se encarga de establecer una relacion de clave ajena entre las tablas,
            //directamente busca la tabla antes del "_" en plural y dentro de ella la columna con el valor despues de "_", que en este caso es id
            $table->string("imagen");
            $table->decimal("precio",6,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("productos");
    }
};
