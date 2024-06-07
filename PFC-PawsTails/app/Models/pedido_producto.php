<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedido_producto extends Model
{
    use HasFactory;

    protected $table = "pedido_producto";

    protected $primaryKey = "id";

    protected $fillable = ["pedido_id", "producto_id", "cantidad"];

    protected $hidden = ["id"];
}
