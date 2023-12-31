<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $primaryKey = "id_categoria";
    
    protected $table = "categorias";
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_id');
    }
}
