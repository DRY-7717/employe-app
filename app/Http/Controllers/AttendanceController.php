<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function indexSchedule()
    {


        $attendances = Attendance::select('date', 'keterangan')->groupBy('date', 'keterangan')->latest()->get();

        return view('dashboard.attendance.index', [
            'title' => "List Attendance",
            'attendances' => $attendances
        ]);
    }

    public function createSchedule()
    {
        return view('dashboard.attendance.create', [
            'title' => "Create Attendance"
        ]);
    }

    public function storeSchedule(Request $request)
    {

        $users = User::all();
        $data = $request->validate([
            'date' => 'required|unique:attendances',
            'keterangan' => 'required'
        ]);


        foreach ($users as $user) {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $data['date'],
                'keterangan' => $data['keterangan']
            ]);
        }

        return redirect('/dashboard/attendance/schedule')->with('message', 'Jadwal absen berhasil dibuat!');
    }
    public function EditSchedule($date)
    {
        $attendance = Attendance::where('date', $date)
            ->select('date', 'keterangan')
            ->groupBy('date', 'keterangan')
            ->first();


        return view('dashboard.attendance.edit', [
            'title' => "Edit Attendance",
            'attendance' => $attendance
        ]);
    }
    public function updateSchedule(Request $request, $date)
    {
        $data = $request->validate([
            'date' => 'required',
            'keterangan' => 'required'
        ]);
        $dates = Attendance::where('date', $date)->get();
        foreach ($dates as $date) {
            Attendance::where('date', $date->date)->update([
                'date' => $data['date'],
                'keterangan' => $data['keterangan']
            ]);
        }

        return redirect('/dashboard/attendance/schedule')->with('message', 'Jadwal absen berhasil diubah!');
    }


    public function deleteSchedule($date)
    {
        Attendance::where('date', $date)->delete();
        return redirect('/dashboard/attendance/schedule')->with('message', 'Jadwal absen berhasil dihapus!');
    }

    public function attendanceUser()
    {
        $attendances = Attendance::latest()->get();

        return view('dashboard.attendance.attendanceUsers', [
            'title' => "List Attendance Users",
            'attendances' => $attendances
        ]);
    }

    public function attendanceUserCheckList()
    {


        $attendanceUser = Attendance::where('user_id', auth()->user()->id)->get();

        return view('dashboard.attendance.attendanceUserList', [
            'title' => "Attendance User list",
            'attendanceUser' => $attendanceUser,
            'today' => Carbon::today()->toDateString()
        ]);
    }


    public function checkIn()
    {

        $attendance = Attendance::where('user_id', auth()->user()->id)
            ->where('date', Carbon::today()->toDateString())
            ->first();

        $endTime = Carbon::today()->setTime(9, 15);

        if ($attendance && is_null($attendance->check_in)) {
            $attendance->check_in = Carbon::now()->toTimeString();

            if (Carbon::now() < $endTime) {
                $attendance->status = "Hadir";
            } else {
                $attendance->status = "Telat";
            }

            if (Carbon::now()->hour >= 17) {
                $attendance->status = "Alpha";
            }

            $attendance->save();
        }

        return redirect('/dashboard/attendance/user/check/list')->with('message', 'Anda sudah absen masuk!');
    }

    public function checkOut()
    {

        $attendance = Attendance::where('user_id', auth()->user()->id)
            ->where('date', Carbon::today()->toDateString())
            ->first();


        if ($attendance && is_null($attendance->check_out)) {
            $attendance->check_out = Carbon::now()->toTimeString();
            $attendance->save();
        }

        return redirect('/dashboard/attendance/user/check/list')->with('message', 'Anda sudah absen keluar!');
    }
}
