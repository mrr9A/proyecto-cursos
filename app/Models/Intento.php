<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intento extends Model
{
    use HasFactory;

    protected $primaryKey = "id_intentos";
    
    protected $table = "intentos";
    public $timestamps = false;

    protected $fillable = ['calificacion','numero_intento','limite_intentos','usuario_id','examen_id'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'intentos','usuario_id','examen_id')->withPivot('limite_intentos');
    }
}
