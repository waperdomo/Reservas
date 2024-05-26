@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservations</h1>
    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Create Reservation</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Laboratory</th>
                <th>User</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->laboratory->type }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->start_time }}</td>
                    <td>{{ $reservation->end_time }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-info">Details</a>
                        <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
