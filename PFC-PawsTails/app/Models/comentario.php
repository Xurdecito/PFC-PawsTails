<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\usuario;
use App\Models\producto;

class comentario extends Model
{
    use HasFactory;

    protected $table = "comentarios";

    protected $primaryKey = "id";

    protected $fillable = ["usuario_id","producto_id","mensaje"];

    protected $hidden = ["id"];

    public function usuario()
    {
        return $this->belongsTo(usuario::class, "usuario_id");
    }

    public function producto()
    {
        return $this->belongsTo(producto::class);
    }
}
