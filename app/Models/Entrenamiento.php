<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use HasFactory;

    public function musculo()
    {
        return $this->belongsTo(Musculo::class, 'musculo_id', 'id'); #Para que se pueda relacionar con la tabla niveles
    }
}
