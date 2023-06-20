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

    protected $fillable = ['nombre','leccion_id'];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'examen_id');
    }
}