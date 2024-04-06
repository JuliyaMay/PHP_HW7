<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'food';

    protected $fillable = [
        'description',
        'prise',
    ];

    // public function animals()
    // {
    //     return $this->belongsToMany(Animal::class, 'food', 'food_id', 'id');
    // }
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}

