<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [];
    public function tallasUnidades(){
        return $this->hasMany(Tallaunidades::class);
    }    
    public function ventas(){
        return $this->belongsToMany(Venta::class)
        ->withPivot('venta_id')
        ->withPivot(['cantidad','precio','talla']);
    }
}
