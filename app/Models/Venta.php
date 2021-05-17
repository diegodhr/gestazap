<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function productos(){
        return $this->belongsToMany(Producto::class)
        ->withPivot('producto_id')
        ->withPivot(['cantidad','precio','talla']);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
