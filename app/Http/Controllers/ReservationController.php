<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('user', 'laboratory')->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $labs = Laboratory::all();
        return view('reservations.create', compact('labs'));
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'laboratory_id' => 'required|exists:laboratories,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'observations' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

    public function edit(Reservation $reservation)
    {
        $labs = Laboratory::all();
        return view('reservations.edit', compact('reservation', 'labs'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validator = Validator::make($request->all(), [
            'laboratory_id' => 'required|exists:laboratories,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'observations' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reservation->update([
            'laboratory_id' => $request->laboratory_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'observations' => $request->observations,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }
}