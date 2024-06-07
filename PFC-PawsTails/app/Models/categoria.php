<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;

class categoria extends Model
{
    use HasFactory;

    protected $table = "categorias";

    protected $primaryKey = "id";

    protected $fillable = ["nombre"];

    protected $hidden = ["id"];

    //Como la categoria pertenece a una tabla ajena se hace esto para indicar la relacion entre las tablas
    public function productos()
    {
        return $this->hasMany(producto::class);
    }
}
