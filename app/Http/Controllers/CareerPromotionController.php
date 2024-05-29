<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class CareerPromotionController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $positions = Position::all();

        return view('dashboard.career.index', [
            'title' => 'Career Advancement',
            'users' => $users,
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'position_id' => 'required'
        ]);
        $user = User::findOrFail($request->user_id);
        $position = Position::findOrFail($request->position_id);
        $user->positions()->sync($position->id);

        return redirect('/dashboard/career')->with('message', 'Karyawan berhasil dipromosikan!');
    }
}
