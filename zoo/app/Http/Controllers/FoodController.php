<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    // public function showAll(Request $request)
    // {
    //     $Foods = Food::all();

    //     return view('Foods', ['FoodList' => $Foods]);
    // }

    // public function showAll(Request $request)
    // {
    //     $Foods = Food::with('animals')->get();

    //     foreach ($Foods as $Food) {
    //         echo $Food->displayWithAnimals();
    //     }
    // }

    public function showAll(Request $request)
    {
        $food = Food::with('animals')->get();

        return view('food', ['foodList' => $food]);
    }

}
