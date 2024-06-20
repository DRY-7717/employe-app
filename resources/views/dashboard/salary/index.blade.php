@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Salary Lists</h3>
                    <p class="text-subtitle text-muted">Halaman list-list gaji setiap posisi</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payroll
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
                        List Gaji Posisi
                    </h5>
                    <a href="/dashboard/payroll/salary/create" class="btn btn-primary">+ Tambah Gaji</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Posisi</th>
                                <th>Gaji</th>
                                <th>Tj. Kesehatan</th>
                                <th>Tj. Pendidikan</th>
                                <th>Tj. Transportasi</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaries as $salary)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $salary->position->name }}</td>
                                    <td>Rp.{{ number_format($salary->salary, '0', '.', '.') }}</td>
                                    <td>Rp.{{ number_format($salary->health_allowance, '0', '.', '.') }}</td>
                                    <td>Rp.{{ number_format($salary->education_allowance, '0', '.', '.') }}</td>
                                    <td>Rp.{{ number_format($salary->transportation_allowance, '0', '.', '.') }}</td>
                                    <td>
                                        <form action="/dashboard/payroll/salary/{{ $salary->id }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('apakah anda yakin?')"
                                                class="badge bg-danger border-0">Delete</button>
                                        </form>
                                        <a href="/dashboard/payroll/salary/{{ $salary->id }}/edit"
                                            class="badge bg-primary">Edit</a>
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
