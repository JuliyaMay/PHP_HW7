<div class="row mt-3 mb-3">
    <div class="col">
        {{ $food->id }}
    </div>
    <div class="col">
        {{ $food->description }}
    </div>
    <div class="col">
        @foreach($food->animals as $animal)
            {{ $animal['name'] }}<br>
        @endforeach
        {{-- {{ $worker->animals }} --}}
    </div>
    {{-- <div class="col">
        <a href="{{ route('customer.data', ['customer' => $customer]) }}">Link</a>
    </div> --}}
</div>