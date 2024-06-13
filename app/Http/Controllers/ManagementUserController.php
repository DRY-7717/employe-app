<?php

namespace App\Http\Controllers;

use App\Models\AnnualLeave;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagementUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {

        $this->middleware('admin')->except(['index', 'show']);
        $this->middleware('hrd')->only(['index', 'show']);
    }
    public function index()
    {

        $users = User::latest()->get();
        return view('dashboard.user.index', [
            'title' => 'Management User',
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $positions = Position::all();
        return view('dashboard.user.create', [
            'title' => 'Create User',
            'positions' => $positions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8',
            'position_id' => 'required'
        ]);

        $data['password'] = Hash::make($data['password']);


        if ($request->position_id == 1) {
            $data['role'] = 1;
        } else if ($request->position_id == 2) {
            $data['role'] = 2;
        } else {
            $data['role'] = 3;
        }

        DB::transaction(function () use ($data, $request) {
            $user = User::create($data);
            $user->positions()->attach($request->position_id);
            AnnualLeave::create([
                'user_id' => $user->id
            ]);
        });
        return redirect('/dashboard/users')->with('message', 'User baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view('dashboard.user.detail', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $positions = Position::all();
        return view('dashboard.user.edit', [
            'title' => 'Create User',
            'positions' => $positions,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|max:8',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = $user->role;

        $user = User::where('id', $user->id)->update($data);

        return redirect('/dashboard/users')->with('message', 'User baru berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('message', 'Data user berhasil dihapus!');
    }
}
