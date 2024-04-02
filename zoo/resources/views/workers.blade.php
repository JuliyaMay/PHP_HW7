@extends('layout')

@section('title', 'List of all workers')

@section('content')
    <div class="container text-center">
        <div class="row mt-3 mb-3">
            <div class="col">
                First name
            </div>
            <div class="col">
                Last name
            </div>
            <div class="col">
                Salary
            </div>
            <div class="col">
                Animal(s)
            </div>
        </div>
        @foreach($workerList as $worker)
            @include('workerRow', ['worker' => $worker])
        @endforeach
    </div>
@endsection