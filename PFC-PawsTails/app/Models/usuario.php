<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    protected $primaryKey = "id";

    protected $fillable = ["nombre","correo","contrasenia","direccion","telefono","rol"];

    protected $hidden = ["id"];

    public function carritos(){
        return $this->hasMany(carrito::class);
    }
    public function adopcion()
    {
        return $this->hasMany(adopcion::class, 'refugio_id');
    }   
}
