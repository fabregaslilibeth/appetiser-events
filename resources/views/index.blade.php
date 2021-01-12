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
                    @foreach($dates as $date)
                        <li class="list-group-item">{{ $date->format('d') }} {{ $date->format('D') }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@endsection
