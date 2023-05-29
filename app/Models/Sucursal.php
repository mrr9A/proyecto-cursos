<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $primaryKey = "id_sucursal";

    public function usuarios(){
        return $this->belongsToMany(User::class,"sucursales_usuarios", "usuario_id","sucursal_id");
    }
}
