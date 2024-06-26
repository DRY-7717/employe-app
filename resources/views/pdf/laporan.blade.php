<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gaji Karyawan {{ date('M') }}</title>
</head>

<body>
    <center>
        <img src="{{ public_path('/img/logo.png') }}" style="width: 250px; margin-bottom: 5px;;" alt="">
        <p>Jl. M.H. Thamrin No.51, RT.9/RW.4, Gondangdia, Kec. Menteng, Kota Jakarta Pusat <br> Daerah Khusus Ibukota Jakarta 10350</p>
        <h3 style="margin-bottom: 0px; margin-top: 0px; text-decoration: underline;">Slip Gaji Karyawan </h3>
        <h3 style="margin-bottom: 50px;">{{ date('d-M-Y', strtotime($userSalary->date)) }}</h4>
    </center>
    
    <table border="0" cellspacing="0" cellpadding="5" style="width: 100%; margin-top:20px;">

        <tr>
            <td style="font-weight: bold">Nama:</td>
            <td>{{ $userSalary->user->name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Jabatan:</td>
            <td>{{ $userSalary->user->positions()->first()->name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Alamat:</td>
            <td>{{ $userSalary->user->profile?->address ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Telp:</td>
            <td>{{ $userSalary->user->profile?->no_hp ?? '-' }}</td>
        </tr>
    </table>
    <hr>
    <table border="0" cellspacing="0" cellpadding="5" style="width: 100%;">

        <tr>
            <td style="font-weight: bold">Gaji Pokok:</td>
            <td>Rp.{{ number_format($userSalary->salary->salary,"0",".",".") }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Tj. Kesehatan:</td>
            <td>Rp.{{ number_format($userSalary->salary->health_allowance,"0",".",".") }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Tj. Transportasi:</td>
            <td>Rp.{{ number_format($userSalary->salary->transportation_allowance,"0",".",".") }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">Tj. Pendidikan:</td>
            <td>Rp.{{ number_format($userSalary->salary->education_allowance,"0",".",".") }}</td>
        </tr>
        @php
            $total = $userSalary->salary->salary + $userSalary->salary->health_allowance + $userSalary->salary->transportation_allowance + $userSalary->salary->education_allowance;
        @endphp
        <tr>
            <td style="font-weight: bold">Total:</td>
            <td>Rp.{{ number_format($total,"0",".",".") }}</td>
        </tr>
    </table>
    <hr>
  <p style="margin-bottom: 60px; margin-top: 40px;">Mengetahui</p>
  <p>Human Resouce Development</p>

</body>

</html>