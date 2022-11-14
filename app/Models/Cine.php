<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cine extends Model
{
    use HasFactory;

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function proyecciones()
    {
        return $this->hasMany(Proyeccion::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
}
