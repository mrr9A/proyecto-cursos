<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_curso extends Model
{
    use HasFactory;
    protected $table = "usuarios_cursos";
    public $timestamps = false;
    protected $fillable = ['usuario_id','curso_id'];
}
