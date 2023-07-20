<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursales';
    protected $primaryKey = "id_sucursal";
    protected $fillable = ["nombre", "ciudad", "estado", "codigo"];
    public $timestamps = false;

    public function usuarios()
    {
        return $this->belongsToMany(User::class, "sucursales_usuarios", "sucursal_id", "usuario_id")->where("usuarios.rol", "=", 1);
    }
}
