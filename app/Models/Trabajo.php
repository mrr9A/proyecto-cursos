<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;
    protected $primaryKey = "id_trabajo";
    protected $table = "trabajos_sumtotal";
    protected $fillable = ["nombre", "estado", "puesto_id"];

    public $timestamps = false;

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'trabajos_cursos', 'trabajo_id', "curso_id");
    }
}
