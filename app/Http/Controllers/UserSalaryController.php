<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\User;
use App\Models\UserSalary;
use Illuminate\Http\Request;

class UserSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userSalaries = UserSalary::latest()->get();

        return view('dashboard.compensation.index', [
            'title' => 'User Compensation',
            'userSalaries' => $userSalaries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();

        return view('dashboard.compensation.create', [
            'title' => 'Create User Compensation',
            'users' => $users
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_id' => 'required',
            'date' => 'required'
        ]);

        $user = User::findOrFail($request->user_id);
        $salary = Salary::where('position_id', $user->positions()->first()->id)->first();

        UserSalary::create([
            'date' => $request->date,
            'user_id' => $user->id,
            'salary_id' => $salary->id,
        ]);
        return redirect('/dashboard/payroll/compensation')->with('message', 'Karyawan berhasil mendapatkan gaji');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSalary $userSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSalary $userSalary)
    {
        //
        $users = User::all();

        return view('dashboard.compensation.edit', [
            'title' => 'Edit User Compensation',
            'users' => $users,
            'userSalary' => $userSalary
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserSalary $userSalary)
    {
        //
        $request->validate([
            'user_id' => 'required',
            'date' => 'required'
        ]);

        $user = User::findOrFail($request->user_id);
        $salary = Salary::where('position_id', $user->positions()->first()->id)->first();

        UserSalary::where('id', $userSalary->id)->update([
            'date' => $request->date,
            'user_id' => $user->id,
            'salary_id' => $salary->id,
        ]);
        return redirect('/dashboard/payroll/compensation')->with('message', 'Gaji karyawan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSalary $userSalary)
    {
        //
        UserSalary::destroy($userSalary->id);
        return redirect('/dashboard/payroll/compensation')->with('message', 'Gaji karyawan berhasil dihapus');
    }
}
