<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tallaunidades extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
