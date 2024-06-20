<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    //

    public function index()
    {
        $salaries = Salary::latest()->get();

        return view('dashboard.salary.index', [
            'title' => 'Employee Salaries',
            'salaries' => $salaries
        ]);
    }

    public function create()
    {

        $positions = Position::latest()->get();
        return view('dashboard.salary.create', [
            'title' => 'Employee Salaries',
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'position_id' => 'required',
            'salary' => 'required',
            'education_allowance' => 'required',
            'health_allowance' => 'required',
            'transportation_allowance' => 'required',
        ]);

        Salary::create($data);
        return redirect('/dashboard/payroll/salary')->with('message', 'Gaji berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $salary = Salary::findOrFail($id);

        $positions = Position::latest()->get();
        return view('dashboard.salary.edit', [
            'title' => 'Employee Salaries Edit',
            'positions' => $positions,
            'salary' => $salary
        ]);
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'position_id' => 'required',
            'salary' => 'required',
            'education_allowance' => 'required',
            'health_allowance' => 'required',
            'transportation_allowance' => 'required',
        ]);

        Salary::where('id', $id)->update($data);
        return redirect('/dashboard/payroll/salary')->with('message', 'Gaji berhasil diubah!');
    }

    public function destroy($id)
    {

        Salary::where('id', $id)->delete();
        return redirect('/dashboard/payroll/salary')->with('message', 'Gaji berhasil dihapus!');
    }
}
