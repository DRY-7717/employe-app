@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>User Compensation</h3>
                    <p class="text-subtitle text-muted">Halaman list gaji karyawan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Compensation
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        List Kompensasi
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Karyawan</th>
                                <th>Date</th>
                                <th>Posisi</th>
                                <th>Gaji Pokok</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userSalaries as $userSalary)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $userSalary->user->name }}</td>
                                    <td>{{ $userSalary->date }}</td>
                                    <td>{{ $userSalary->user->positions()->first()->name }}</td>
                                    <td>Rp.{{ number_format($userSalary->salary->salary, '0', '.', '.') }}</td>
                                    <td>
                                        <a href="/dashboard/payroll/user/compensation/{{ $userSalary->id }}"
                                            class="badge bg-info">Check</a>
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
