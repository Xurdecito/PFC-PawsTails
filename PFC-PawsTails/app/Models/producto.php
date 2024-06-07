<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categoria;

class Producto extends Model
{
    use HasFactory;
    
    protected $table = "productos";

    protected $primaryKey = "id";

    protected $fillable = ["nombre", "descripcion", "categoria_id", "imagen", "precio"];

    protected $hidden = ["id"];

    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }

   
}

