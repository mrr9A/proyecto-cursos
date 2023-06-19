<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalidadCurso extends Model
{
    use HasFactory;
    protected $table = "modalidad_cursos";
    protected $fillable = ["modalidad", "estado"];
    public $timestamps = false;
}
