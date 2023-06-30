<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    use HasFactory;

    protected $primaryKey = "id_contenido";
    
    protected $table = "contenidos";
    public $timestamps = false;

    protected $fillable = ['nombre','descripcion','leccion_id','estado'];

    public function leccion()
    {
        return $this->belongsTo(Leccion::class, 'leccion_id');
    }

    public function media()
    {
        return $this->hasMany(Media_contenido::class, 'contenido_id');
    }

    public function examen()
    {
        return $this->hasMany(Examen::class, 'contenido_id');
    }
}