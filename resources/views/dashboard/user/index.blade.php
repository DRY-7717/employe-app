@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>User Lists</h3>
                    <p class="text-subtitle text-muted">Halaman list-list user</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User
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
                        List user
                    </h5>
                    @can('admin')
                        <a href="/dashboard/users/create" class="btn btn-primary">+ Tambah user</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->positions->first()->name ?? '-' }}</td>
                                    <td>
                                        <a href="/dashboard/users/{{ $user->id }}" class="badge bg-info">Detail</a>
                                        @can('admin')
                                            <a href="/dashboard/users/{{ $user->id }}/edit"
                                                class="badge bg-primary">Edit</a>
                                            <form action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('apakah anda yakin?')"
                                                    class="badge bg-danger border-0">Delete</button>
                                            </form>
                                        @endcan
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
