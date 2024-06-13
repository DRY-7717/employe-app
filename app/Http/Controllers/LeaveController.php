<?php

namespace App\Http\Controllers;

use App\Models\AnnualLeave;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeaveController extends Controller
{
    //

    public function index()
    {
        $leaverequests = Leave::where('user_id', auth()->user()->id)->latest()->get();
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

            return redirect('/dashboard/leave/request')->with('message', 'Pengajuan cutimu berhasil, mohon tunggu untuk dikonfirmasi!');
        } else {
            return redirect('/dashboard/leave/request')->with('failed', 'Pengajuan cutimu gagal, karna melebihi limit quota cuti');
        }
    }

    public function edit($id)
    {
        $leaverequest = Leave::where('id', $id)->where('user_id', auth()->user()->id)->first();


        return view('dashboard.leave.edit', [
            'title' => 'Edit Leave Request',
            'leaverequest' => $leaverequest
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
            'proof' => 'image|file|max:2054',
        ]);

        $quotaLeaveUser = AnnualLeave::where('user_id', auth()->user()->id)->first();
        $leaverequest = Leave::where('id', $id)->where('user_id', auth()->user()->id)->first();

        $dayRequested = (new \DateTime($request->end_date))->diff(new \DateTime($request->start_date))->days + 1;

        if ($request->file('proof')) {
            if ($leaverequest->proof) {
                Storage::delete($leaverequest->proof);
            }
            $data['proof'] = $request->file('proof')->store('leave_proofs');
        }

        if ($request->start_date != $leaverequest->start_date || $request->end_date != $leaverequest->end_date) {
            
            $oldDuration = (new \DateTime($leaverequest->end_date))->diff(new \DateTime($leaverequest->start_date))->days + 1;
            $newDuration = (new \DateTime($request->end_date))->diff(new \DateTime($request->start_date))->days + 1;

            // Mengurangi annual_leave dengan perbedaan jumlah hari

            $difference = $newDuration - $oldDuration;
            $quotaLeaveUser->annual_leave -= $difference;
            $quotaLeaveUser->save();
        }

        $data['user_id'] = auth()->user()->id;
        $leaverequest->update($data);

        return redirect('/dashboard/leave/request')->with('message', 'Pengajuan cutimu berhasil diubah, mohon tunggu untuk dikonfirmasi!');
    }

    public function destroy($id)
    {
        $quotaLeaveUser = AnnualLeave::where('user_id', auth()->user()->id)->first();
        $leaverequest = Leave::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if ($leaverequest->proof) {
            Storage::delete($leaverequest->proof);
        }
        $dayRequested = (new \DateTime($leaverequest->end_date))->diff(new \DateTime($leaverequest->start_date))->days + 1;
        $quotaLeaveUser->annual_leave == 12 ? $quotaLeaveUser->annual_leave += 0 : $quotaLeaveUser->annual_leave += $dayRequested;
        $quotaLeaveUser->save();

        $leaverequest->delete();
        return redirect('/dashboard/leave/request')->with('message', 'Pengajuan cutimu berhasil dibatalkan!');
    }

    public function confirmpage()
    {
        $leaverequests = Leave::latest()->get();
        return view('dashboard.leave.confirm', [
            'title' => 'Confirm Leave Request',
            'leaverequests' => $leaverequests
        ]);
    }

    public function detailconfirm($id)
    {
        $leaverequest = Leave::findOrFail($id);

        return view('dashboard.leave.detailconfirm', [
            'title' => 'Detail Confirm Leave Request',
            'leaverequest' => $leaverequest
        ]);
    }
    public function confirmrequest(Request $request, $id)
    {
        $leaverequest = Leave::findOrFail($id);
        $userId = $leaverequest->user->id;
        $quotaLeaveUser = AnnualLeave::where('user_id', $userId)->first();
        $dayRequested = (new \DateTime($leaverequest->end_date))->diff(new \DateTime($leaverequest->start_date))->days + 1;


        if ($request->approve == "Approve") {
            $leaverequest->status = "Approve";
            $quotaLeaveUser->annual_leave == 12 ? $quotaLeaveUser->annual_leave -= $dayRequested : $quotaLeaveUser->annual_leave += 0;

            $quotaLeaveUser->save();
        } else if ($request->failed == "Failed") {
            $leaverequest->status = "Failed";
            $quotaLeaveUser->annual_leave != 12 ? $quotaLeaveUser->annual_leave += $dayRequested : $quotaLeaveUser->annual_leave += 0;
            $quotaLeaveUser->save();
        } else {
            return redirect('/dashboard/leave/confirm')->with('failed', 'Permintaan pengajuan cuti karyawan gagal dikonfirmasi!');
        }
        $leaverequest->save();

        return redirect('/dashboard/leave/confirm')->with('message', 'Permintaan pengajuan cuti karyawan berhasil dikonfirmasi!');
    }
}
