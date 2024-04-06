<div class="row mt-3 mb-3">
    <div class="col">
        {{ $worker->first_name }}
    </div>
    <div class="col">
        {{ $worker->last_name  }}
    </div>
    <div class="col">
        {{ $worker->salary }}
    </div>
    <div class="col">
        @foreach($worker->animals as $animal)
            {{ $animal['name'] }}<br>
        @endforeach
        {{-- {{ $worker->animals }} --}}
    </div>
    {{-- <div class="col">
        <a href="{{ route('customer.data', ['customer' => $customer]) }}">Link</a>
    </div> --}}
</div>