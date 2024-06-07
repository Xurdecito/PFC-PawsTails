<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adopcion extends Model
{
    use HasFactory;
    protected $table = "adopciones";

    protected $primaryKey = "id";

    protected $fillable = ["usuario_id","animale_id","refugio_id","estado"];

    protected $hidden = ["id"];

    public function animal(){
        return $this->belongsTo(animal::class, "animale_id");
    }

    public function refugio(){
        return $this->belongsTo(usuario::class, "refugio_id");
    }

    public function usuario(){
        return $this->belongsTo(usuario::class, "usuario_id");
    }
}
