<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    public function rol(){
        return $this->belongsTo(Rol::class);
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }    
}
