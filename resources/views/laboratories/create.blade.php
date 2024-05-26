<!-- resources/views/laboratories/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="" style="text-align: center; color:tomato; ">Crear Nuevo Laboratorio</h1>
        <br>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('laboratories.store') }}">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Nombre del Laboratorio</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="form-group">
                <label for="capacity" class="form-label">Capacidad</label>
                <input type="number" class="form-control" id="capacity" name="capacity" step="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Laboratorio</button>
        </form>
    </div>
@endsection
