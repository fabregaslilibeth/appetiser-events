@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row m-4">
            <div class="col-4">
                <create-event></create-event>
            </div>
            <div class="col-8">
                <ul class="list-group list-group-flush">
                    {{ $period->format('M Y')  }}
                    @foreach($withEvents as $event)
                        <li class="list-group-item {{ json_decode(($event))->name ? 'bg-success' : '' }}">
                            {{ json_decode(($event))->date }}
                            {{ json_decode(($event))->day }}
                            {{ ucwords(json_decode(($event))->name) }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@endsection
