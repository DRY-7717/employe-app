@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail User</h3>
                    <p class="text-subtitle text-muted">Halaman untuk melihat detail user</p>
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
            <div class="card">
                <div class="card-body">
                    @if ($user->profile)
                        <form class="form">
                            <div class="card-header text-center">
                                @if ($user->profile?->img_profile)
                                    <img src="{{ asset('storage/' . $user->profile->img_profile) }}"
                                        class=" img-preview  img-fluid rounded-circle mb-3  "
                                        style="width: 150px; height: 150px; object-fit: cover; object-position: top;"
                                        alt="">

                                    <p class="m-0 p-0 text-light fw-semibold">
                                        {{ $user->positions->first()->name ?? '-' }}</p>
                                @else
                                    <img src="/assets/static/images/faces/2.jpg"
                                        class=" img-preview  img-fluid rounded-circle mb-3 "
                                        style="width: 150px; height: 150px; object-fit: cover; object-position: top;"
                                        alt="">
                                    <p class="m-0 p-0 text-light fw-semibold">
                                        {{ $user->positions->first()->name ?? '-' }}</p>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" class="form-control "
                                                value="{{ $user->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" class="form-control"
                                                value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="no_hp">No. Handphone</label>
                                            <input type="text" id="no_hp" class="form-control"
                                                value="{{ $user->profile->no_hp }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" id="tgl_lahir" class="form-control"
                                                value="{{ $user->profile->tgl_lahir }}" disabled>

                                        </div>

                                    </div>
                                    <div class=" col-12">
                                        <div class="form-group mb-3">
                                            <label for="address" class="form-label mb-0">Address</label>
                                            <textarea class="form-control mt-1 @error('address') is-invalid @enderror" id="address" rows="3" name="address"
                                                disabled>{{ $user->profile->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="/dashboard/users" class="btn btn-primary me-1 mb-1">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <h5 class="text-center">User ini belum melengkapi profilenya.</h5>
                    @endif

                </div>
            </div>
        </section>
    </div>
@endsection
