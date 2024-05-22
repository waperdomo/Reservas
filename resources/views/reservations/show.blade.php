@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservation Details</h1>
    <div class="card">
        <div class="card-header">
            Reservation #{{ $reservation->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Lab: {{ $reservation->laboratory->type }}</h5>
            <p class="card-text"><strong>Requested by:</strong> {{ $reservation->user->name }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $reservation->user->email }}</p>
            <p class="card-text"><strong>Identification:</strong> {{ $reservation->user->identification }}</p>
            <p class="card-text"><strong>Academic Program:</strong> {{ $reservation->user->academic_program }}</p>
            <p class="card-text"><strong>Request Date:</strong> {{ $reservation->request_date }}</p>
            <p class="card-text"><strong>Start Time:</strong> {{ $reservation->start_time}}</p>
            <p class="card-text"><strong>End Time:</strong> {{ $reservation->end_time}}</p>
            <p class="card-text"><strong>Observations:</strong> {{ $reservation->observations }}</p>
            <a href="{{ route('reservations.index') }}" class="btn btn-primary">Back to Reservations</a>
            <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
