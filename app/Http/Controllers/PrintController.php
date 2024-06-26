<?php

namespace App\Http\Controllers;

use App\Models\UserSalary;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    //

    public function print($id)  {
        
        $userSalary = UserSalary::where('user_id', $id)->latest()->first();
        $pdf = Pdf::loadView("pdf.laporan", ['userSalary' => $userSalary])->setPaper("a4", "landscape");
        return $pdf->download('GAJI-KARYAWAN-'. date('M'). '.pdf');
    }
}
