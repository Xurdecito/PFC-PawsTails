<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrito extends Model
{
    use HasFactory;
    protected $table = "carritos";

    protected $primaryKey = "id";

    protected $fillable = ["usuario_id","producto_id","cantidad"];

    protected $hidden = ["id"];

    //Para indicar la relacion del carrito con la tabla de usuarios, un usuario tiene muchos carritos, ya que cada uno de ellos solo alberga a un usuario
    public function usuario()
    {
        return $this->belongsTo(usuario::class);
    }

    //Para indicar la relacion del carrito con la tabla de productos, un producto tiene muchos carritos, ya que cada uno de ellos solo alberga a un producto
    public function producto()
    {
        return $this->belongsTo(producto::class);
    }

    public function adopcion()
    {
        return $this->hasMany(adopcion::class, 'animale_id');
    }
}
