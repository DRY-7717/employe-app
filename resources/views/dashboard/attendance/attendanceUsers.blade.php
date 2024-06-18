@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Attendance Users</h3>
                    <p class="text-subtitle text-muted">Halaman list-list absensi user</p>
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
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>{{ $attendance->keterangan }}</td>
                                    <td>
                                        @if ($attendance->status == 'Hadir')
                                            <span class="badge bg-success rounded-pill">{{ $attendance->status }}</span>
                                        @endif
                                        @if ($attendance->status == 'Telat')
                                            <span class="badge bg-warning rounded-pill">{{ $attendance->status }}</span>
                                        @endif
                                        @if ($attendance->status == 'Alpha')
                                            <span class="badge bg-danger rounded-pill">{{ $attendance->status }}</span>
                                        @endif
                                        @if ($attendance->status == 'Cuti')
                                            <span class="badge bg-secondary rounded-pill">{{ $attendance->status }}</span>
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
