@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Reservation</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="laboratory_id">Lab</label>
            <select id="laboratory_id" name="laboratory_id" class="form-control" required>
                @foreach($labs as $lab)
                    <option value="{{ $lab->id }}" {{ $reservation->lab_id == $lab->id ? 'selected' : '' }}>{{ $lab->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" id="start_time" name="start_time" class="form-control" value="{{ $reservation->start_time }}" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="datetime-local" id="end_time" name="end_time" class="form-control" value="{{ $reservation->end_time }}" required>
        </div>
        <div class="form-group">
            <label for="observations">Observations</label>
            <textarea id="observations" name="observations" class="form-control">{{ $reservation->observations }}</textarea>
        </div>
        <a href="{{ route('reservations.index') }}" class="btn btn-primary">Back to Reservations</a>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
