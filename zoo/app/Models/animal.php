<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animals';

    protected $fillable = [
        'animal',
        'name',
        'age',
        'food',
        'worker',
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public function food()
    {
        return $this->hasMany(Food::class);
    }
}
