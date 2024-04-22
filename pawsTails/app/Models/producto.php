<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categoria;

class producto extends Model
{
    use HasFactory;
    
    protected $table = "productos";

    protected $primaryKey = "id";

    protected $fillable = ["nombre", "descripcion", "categoria_id", "imagen", "precio"];

    protected $hidden = ["id"];

    //Como la categoria pertenece a una tabla ajena se hace esto para indicar la relacion entre las tablas
    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }
}
