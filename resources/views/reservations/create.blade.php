@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Reservation</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="laboratory_id">Laboratory</label>
            <select id="laboratory_id" name="laboratory_id" class="form-control" required>
                @foreach($labs as $lab)
                    <option value="{{ $lab->id }}">{{ $lab->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Reservation Start Time</label>
            <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">Reservation End Time</label>
            <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="observations">Observations</label>
            <textarea id="observations" name="observations" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
