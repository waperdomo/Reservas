<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Rules\UniqueReservation;

class ReservationController extends Controller
{   
    // Muestra todas las reservas del usuario actual
    public function index()
    {   
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('reservations.index', compact('reservations'));
    }

    // Muestra el formulario para crear una nueva reserva
    public function create()
    {
        $labs = Laboratory::all();
        return view('reservations.create', compact('labs'));
    }

    // Almacena una nueva reserva en la base de datos
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'laboratory_id' => 'required',
            'start_time' => [
                'required',
                'date',
                'after_or_equal:now',
                // Agrega la Rule personalizada para asegurar que no haya reservas en el mismo laboratorio y tiempo
                new UniqueReservation($request->laboratory_id, $request->start_time, $request->end_time),
            ],
            'end_time' => 'required|date|after:start_time',
            'observations' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Crear la reserva
        Reservation::create([
            'user_id' => auth()->id(),
            'laboratory_id' => $request->laboratory_id,
            'request_date' => now(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'observations' => $request->observations,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    // Muestra el formulario para editar una reserva
    public function edit(Reservation $reservation)
    {
        $labs = Laboratory::all();
        // Verifica la policy para que solo el usuario que creo la reserva pueda ver el formulario de actualizar
        if (Gate::denies('update', $reservation)) {
            abort(403, 'Unauthorized action.');
        }
        return view('reservations.edit', compact('reservation', 'labs'));
    }
    
    // Actualiza una reserva existente en la base de datos
    public function update(Request $request, Reservation $reservation)
    {
        
        $validator = Validator::make($request->all(), [
            'laboratory_id' => 'required',
            'start_time' => [
                'required',
                'date',
                'after_or_equal:now',
                // Agrega la Rule personalizada para asegurar que no haya reservas en el mismo laboratorio y tiempo
                new UniqueReservation($request->laboratory_id, $request->start_time, $request->end_time),
            ],
            'end_time' => 'required|date|after:start_time',
            'observations' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Verifica la policy para que solo el usuario que creo la reserva la pueda actualizar
        if (Gate::denies('update', $reservation)) {
            abort(403, 'Unauthorized action.');
        }
        // Actualizar la reserva
        $reservation->update([
            'laboratory_id' => $request->laboratory_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'observations' => $request->observations,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    // Elimina una reserva existente de la base de datos
    public function destroy(Reservation $reservation)
    {   
        
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }

    // Muestra los detalles de una reserva específica
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function active()
    {
        // Obtener las reservas activas del usuario actual
        $currentDateTime = now();
        $reservations = Reservation::where('user_id', auth()->id())
                                ->where('end_time', '>', $currentDateTime)
                                ->get();

        return view('reservations.active', compact('reservations'));
    }
}