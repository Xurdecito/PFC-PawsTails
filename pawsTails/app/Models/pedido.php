<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\usuario;
use App\Models\producto;

class pedido extends Model
{
    use HasFactory;
    
    protected $table = "pedidos";

    protected $primaryKey = "id";

    protected $fillable = ["usuario_id","num_pedido"];

    protected $hidden = ["id"];

    public function usuario()
    {
        return $this->belongsTo(usuario::class, 'usuario_id');
    }

    
}
