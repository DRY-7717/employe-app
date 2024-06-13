<?php

namespace App\Http\Controllers;

use App\Models\AnnualLeave;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    //

    public function index()
    {
        $leaverequests = Leave::where('user_id', auth()->user()->id)->get();
        $quota = AnnualLeave::where('user_id', auth()->user()->id)->first();
        return view('dashboard.leave.index', [
            'title' => 'Leave Request',
            'leaverequests' => $leaverequests,
            'quota' => $quota
        ]);
    }

    public function create()
    {
        return view('dashboard.leave.create', [
            'title' => 'Create Leave Request'
        ]);
    }
    public function store(Request $request)
    {
        $quotaLeaveUser = AnnualLeave::where('user_id', auth()->user()->id)->first();
        $data = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
            'proof' => 'required|image|file|max:2054',
        ]);
        $dayRequested = (new \DateTime($request->end_date))->diff(new \DateTime($request->start_date))->days + 1;

        if ($request->file('proof')) {
            $data['proof'] = $request->file('proof')->store('leave_proofs');
        }
        $data['user_id'] = auth()->user()->id;

        if ($dayRequested <= $quotaLeaveUser->annual_leave) {
            Leave::create($data);
            $quotaLeaveUser->annual_leave -= $dayRequested;
            $quotaLeaveUser->save();

            return redirect('/dashboard/leave')->with('message', 'Pengajuan cutimu berhasil, mohon tunggu untuk dikonfirmasi!');
        } else {
            return redirect('/dashboard/leave')->with('failed', 'Pengajuan cutimu gagal, karna melebihi limit quota cuti');
        }
    }

    
}
