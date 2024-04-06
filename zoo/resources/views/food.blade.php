@extends('layout')

@section('title', 'List of all food')

@section('content')
    <div class="container text-center">
        <div class="row mt-3 mb-3">
            <div class="col">
                ID
            </div>
            <div class="col">
                Food
            </div>
            <div class="col">
                Animal(s)
            </div>
        </div>
        @foreach($foodList as $food)
            @include('foodRow', ['food' => $food])
        @endforeach
    </div>
@endsection