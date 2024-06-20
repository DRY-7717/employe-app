<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\UserSalary;
use Illuminate\Http\Request;

class UserCompensationController extends Controller
{
    //

    public function index()
    {
        $userSalaries =  UserSalary::where('user_id', auth()->user()->id)->latest()->get();
        
        return view('dashboard.usercompensation.index',[
            'title' => "User Compensation",
            'userSalaries' => $userSalaries
        ]);
    }
    public function show($id)
    {
        $userSalary =  UserSalary::findOrFail($id);
        $positions = Position::all();
        
        return view('dashboard.usercompensation.detail',[
            'title' => "Detail User Compensation",
            'userSalary' => $userSalary,
            'positions' => $positions
        ]);

      
        
    }
}
