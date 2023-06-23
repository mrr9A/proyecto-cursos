<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $primaryKey = "id_pregunta";
    
    protected $table = "preguntas";
    public $timestamps = false;

    protected $fillable = ['pregunta','examen_id'];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'id_examen');
    }

    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'pregunta_id');
    }

    public function respuesta()
    {
        return $this->belongsTo(Respuesta::class, 'pregunta_id');
    }
}
