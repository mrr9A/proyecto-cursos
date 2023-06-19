<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    use HasFactory;

    protected $primaryKey = "id_opciones";
    
    protected $table = "opciones";
    public $timestamps = false;

    protected $fillable = ['opcion','pregunta_id','respuesta'];

    public function preguntas()
    {
        return $this->belongsTo(Pregunta::class, 'id_pregunta');
    }
}
