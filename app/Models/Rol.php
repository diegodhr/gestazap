<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'tipo'
    ];

    // public function users(){
    //     return $this->hasMany(User::class);
    // }
}
