<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $primaryKey = "id_leccion";
    
    protected $table = "lecciones";
    public $timestamps = false;

    protected $fillable = ['nombre','descripcion','url_imagen','curso_id'];

    public function course()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
    public function contenido()
    {
        return $this->hasMany(Contenido::class, 'leccion_id');
    }
}
