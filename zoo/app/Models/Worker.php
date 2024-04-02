<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $table = 'workers';

    protected $fillable = [
        'first_name',
        'last_name',
        'salary',
    ];


    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    

    public function displayWithAnimals()
    {
        $info = "Співробітник: {$this->first_name} {$this->last_name}\nТварини:\n";
        foreach ($this->animals as $animal) {
            $info .= "- {$animal->name}\n";
        }
        return $info;
    }

}
