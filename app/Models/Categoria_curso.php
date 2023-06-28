<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_curso extends Model
{
    use HasFactory;

    protected $table = "categorias_cursos";
    public $timestamps = false;
    protected $fillable = ['categoria_id','curso_id'];
}
