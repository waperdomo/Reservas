<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laboratories = Laboratory::all();

        return view('laboratories.index', compact('laboratories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laboratories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:55',
            'capacity' => 'required|integer|min:1',
        ]);
        Laboratory::create([
            'type' => $request->type,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('laboratories.create')->with('success', 'Laboratorio creado correctamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
