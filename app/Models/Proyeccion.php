<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'cine_id',
        'pelicula_id',
        'fecha',
        'hora_inicio',
        'sala'
    ];

    public function cine()
    {
        return $this->belongsTo(Cine::class);
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }
}
