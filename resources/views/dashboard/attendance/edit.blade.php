@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Attendance</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengubah jadwal absensi</p>
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
            <div class="card">
                <form action="/dashboard/attendance/schedule/{{ $attendance->date }}" method="POST" class="form">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="date">Tanggal Absensi</label>
                                    <input type="date" id="date"
                                        class="form-control @error('date') is-invalid @enderror"
                                        placeholder="Input nama posisi" name="date"
                                        value="{{ old('date', $attendance->date ?? '') }}">

                                    @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <select
                                        class="form-select @error('keterangan')
                                        is-invalid @enderror"
                                        name="keterangan">
                                        <option selected disabled>Pilih keterangan</option>
                                        @if ($attendance->keterangan == 'Masuk')
                                            <option selected value="Masuk">Masuk</option>
                                            <option value="Libur">Libur</option>
                                        @else
                                            <option selected value="Libur">Libur</option>
                                            <option value="Masuk">Masuk</option>
                                        @endif

                                    </select>

                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
