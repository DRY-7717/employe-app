@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Leave Request Lists</h3>
                    <p class="text-subtitle text-muted">Halaman list-list permohonan cuti</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leave Request
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
            @if (session('failed'))
                <div class="alert alert-light-danger color-danger">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ session('failed') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Quota Cuti: {{ $quota->annual_leave }}
                    </h5>

                    @if ($leaverequests->isEmpty() || $leaverequests->first()->status != 'Pending')
                        <a href="/dashboard/leave/request/create" class="btn btn-primary">+ Buat Permohonan Cuti</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Awal Tanggal Cuti</th>
                                <th>Akhir Tanggal Cuti</th>
                                <th>Alasan</th>
                                <th>Status</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaverequests as $leaverequest)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $leaverequest->start_date }}</td>
                                    <td>{{ $leaverequest->end_date }}</td>
                                    <td>{{ $leaverequest->reason }}</td>
                                    <td>
                                        @if ($leaverequest->status == 'Pending')
                                            <span class="badge bg-warning">{{ $leaverequest->status }}</span>
                                        @endif
                                        @if ($leaverequest->status == 'Approve')
                                            <span class="badge bg-success">{{ $leaverequest->status }}</span>
                                        @endif
                                        @if ($leaverequest->status == 'Failed')
                                            <span class="badge bg-danger">{{ $leaverequest->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($leaverequest->status == 'Pending')
                                            <form action="/dashboard/leave/request/{{ $leaverequest->id }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('apakah anda yakin?')"
                                                    class="badge bg-danger border-0">Delete</button>
                                            </form>
                                            <a href="/dashboard/leave/request/{{ $leaverequest->id }}/edit"
                                                class="badge bg-primary">Edit</a>
                                        @else
                                            <span class="badge bg-info">no control</span>
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
