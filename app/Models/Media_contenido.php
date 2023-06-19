<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media_contenido extends Model
{
    use HasFactory;

    protected $primaryKey = "id_media";
    
    protected $table = "media_contenidos";
    public $timestamps = false;

    protected $fillable = ['url','contenido_id'];

    public function contenidos()
    {
        return $this->belongsTo(Contenido::class, 'id_contenido');
    }
}
