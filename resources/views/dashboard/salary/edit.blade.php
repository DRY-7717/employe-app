@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Employee Salary</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengubah gaji karyawan</p>
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
            <div class="card">
                <form action="/dashboard/payroll/salary/{{ $salary->id }}" method="POST" class="form">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="position_id">Posisi</label>
                                    <select
                                        class="form-select @error('position_id')
                                        is-invalid @enderror"
                                        name="position_id">
                                        <option selected disabled>Pilih posisi</option>
                                        @foreach ($positions as $position)
                                            @if ($salary->position_id == $position->id)
                                                <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                            @else
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('position_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="salary">Gaji</label>
                                    <input type="text" id="salary"
                                        class="form-control @error('salary') is-invalid @enderror"
                                        placeholder="Input gaji pokok" name="salary" value="{{ old('salary', $salary->salary) }}">
                                    @error('salary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="health_allowance">Tunjangan Kesehatan</label>
                                    <input type="text" id="health_allowance"
                                        class="form-control @error('health_allowance') is-invalid @enderror"
                                        placeholder="Input tunjangan kesehatan" name="health_allowance"
                                        value="{{ old('health_allowance', $salary->health_allowance) }}">
                                    @error('health_allowance')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="education_allowance">Tunjangan Pendidikan</label>
                                    <input type="text" id="education_allowance"
                                        class="form-control @error('education_allowance') is-invalid @enderror"
                                        placeholder="Input tunjangan pendidikan" name="education_allowance"
                                        value="{{ old('education_allowance', $salary->education_allowance) }}">
                                    @error('education_allowance')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="transportation_allowance">Tunjangan Transportasi</label>
                                    <input type="text" id="transportation_allowance"
                                        class="form-control @error('transportation_allowance') is-invalid @enderror"
                                        placeholder="Input tunjangan transportasi" name="transportation_allowance"
                                        value="{{ old('transportation_allowance', $salary->transportation_allowance) }}">
                                    @error('transportation_allowance')
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
