<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\usuario;
class animal extends Model
{
    use HasFactory;
    protected $table = "animales";

    protected $primaryKey = "id";

    protected $fillable = ["nombre","especie","descripcion","adoptado","usuario_id","imagen"];

    protected $hidden = ["id"];

    //Para poder acceder a los campos de la tabla usuarios
    public function usuario(){
        return $this->belongsTo(usuario::class);
    }
}
