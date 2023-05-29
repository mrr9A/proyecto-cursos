<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCurso extends Model
{
    use HasFactory;
    protected $primaryKey = "id_tipo_curso";

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_tipo_curso');
    }
}
