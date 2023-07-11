<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $primaryKey = "id_examen";
    
    protected $table = "examen";
    public $timestamps = false;

    protected $fillable = ['nombre','duracion','contenido_id','curso_id'];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'examen_id');
    }

    public function contenido()
    {
        return $this->belongsTo(Contenido::class, 'contenido_id');
    }

    public function cursos()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'intentos','examen_id','usuario_id')->withPivot('limite_intentos','numero_intento','calificacion');
    }


}
