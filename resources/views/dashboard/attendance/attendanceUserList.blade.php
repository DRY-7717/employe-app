@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Attendance User List</h3>
                    <p class="text-subtitle text-muted">Halaman absensi user</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Attendance
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            @if (session('message'))
                <div class="alert alert-light-success color-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        List absensi
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Keterangan</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendanceUser as $as)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $as->user->name }}</td>
                                    <td>{{ $as->date }}</td>
                                    <td>
                                        @if ($as->status == 'Hadir')
                                            <span class="badge bg-success rounded-pill">{{ $as->status }}</span>
                                        @endif
                                        @if ($as->status == 'Telat')
                                            <span class="badge bg-warning rounded-pill">{{ $as->status }}</span>
                                        @endif
                                        @if ($as->status == 'Alpha')
                                            <span class="badge bg-danger rounded-pill">{{ $as->status }}</span>
                                        @endif

                                    </td>
                                    <td>{{ $as->check_in ?? '-' }}</td>
                                    <td>{{ $as->check_out ?? '-' }}</td>
                                    <td>{{ $as->keterangan }}</td>
                                    <td>
                                        @php
                                            $hometime = Carbon\Carbon::now()->hour == 17;
                                        @endphp

                                        @if ($as->date == $today)
                                            @if ($hometime)
                                                <form action="/dashboard/attendance/user/checkout" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="border-0 btn btn-primary">Absen
                                                        Keluar</button>
                                                </form>
                                            @else
                                                <form action="/dashboard/attendance/user/checkin" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="border-0 btn btn-primary">Absen
                                                        Masuk</button>
                                                </form>
                                            @endif
                                        @else
                                            <button type="button" class="border-0 btn btn-info">Sudah Absen</button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
