
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mis Reservas Activas</h1>

        <!-- Verificar si hay reservas activas -->
        @if($reservations->isEmpty())
            <p>No tienes reservas activas.</p>
        @else
            <!-- Mostrar cada reserva activa -->
            @foreach($reservations as $reservation)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $reservation->laboratory->type }}</h5>
                        <p class="card-text">Desde: {{ $reservation->start_time }}</p>
                        <p class="card-text">Hasta: {{ $reservation->end_time }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
