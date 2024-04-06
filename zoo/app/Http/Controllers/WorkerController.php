<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;

class WorkerController extends Controller
{
    // public function showAll(Request $request)
    // {
    //     $workers = Worker::all();

    //     return view('workers', ['workerList' => $workers]);
    // }

    // public function showAll(Request $request)
    // {
    //     $workers = Worker::with('animals')->get();

    //     foreach ($workers as $worker) {
    //         echo $worker->displayWithAnimals();
    //     }
    // }

    public function showAll(Request $request)
    {
        $workers = Worker::with('animals')->get();

        return view('workers', ['workerList' => $workers]);
    }

}
