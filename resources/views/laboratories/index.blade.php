@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Available Laboratories</div>

                    <div class="card-body">
                        <ul>
                            @forelse ($laboratories as $laboratory)
                                <li>{{ $laboratory->type }} - Capacity: {{ $laboratory->capacity }}</li>
                            @empty
                                <li>No laboratories available for the selected time range.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('laboratories.create') }}" class="btn btn-primary justify-content-center">Create Reservation</a>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>
@endsection
