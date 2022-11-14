<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public $fillable = ['user_id', 'cine_id', 'pelicula_id', 'hora_inicio', 'sala', 'asiento'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cine()
    {
        return $this->belongsTo(Cine::class);
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }
}
