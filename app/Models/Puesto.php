<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    protected $primaryKey = "id_puesto";
    public $timestamps = false;

    protected $fillable = ["codigo","puesto", "estado", "plan_formacion_id"];

    public function usuarios()
    {
        return $this->hasMany(User::class, "puesto_id", "id_puesto");
    }

    public function planes_formacion()
    {
        return $this->belongsTo(PlanesFormacion::class, "plan_formacion_id");
    }

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class, "puesto_id", 'id_puesto');
    }

    public static function getPuestosByPlanformacion()
    {
    }
   
}
