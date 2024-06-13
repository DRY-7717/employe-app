<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $positions = Position::latest()->get();
        return view('dashboard.position.index', [
            'title' => 'All Position',
            'positions' => $positions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.position.create', [
            'title' => 'Create Position'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate(['name' => 'required|unique:positions']);

        Position::create($data);

        return redirect('/dashboard/position')->with('message', 'Posisi baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
        return view('dashboard.position.edit', [
            'title' => 'Edit Position',
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        //
        $data = $request->validate(['name' => 'required|unique:positions']);
        Position::where('id', $position->id)->update($data);
        return redirect('/dashboard/position')->with('message', 'Posisi baru berhasil diubah!');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
        Position::destroy($position->id);
        return redirect('/dashboard/position')->with('message', 'Posisi baru berhasil dihapus!');
    }
}
