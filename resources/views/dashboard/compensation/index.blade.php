@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Compensation</h3>
                    <p class="text-subtitle text-muted">Halaman list-list gaji karyawan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Compensation
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
                    <a href="/dashboard/payroll/compensation/create" class="btn btn-primary">+ Tambah Kompensasi</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Karyawan</th>
                                <th>Date</th>
                                <th>Posisi</th>
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
                                    <td>
                                        <form action="/dashboard/payroll/compensation/{{ $userSalary->id }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('apakah anda yakin?')"
                                                class="badge bg-danger border-0">Delete</button>
                                        </form>
                                        <a href="/dashboard/payroll/compensation/{{ $userSalary->id }}/edit"
                                            class="badge bg-primary">Edit</a>
                                        <a href="/dashboard/print/{{ $userSalary->user->id }}" target="blank" class="badge bg-info">Print</a>
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
