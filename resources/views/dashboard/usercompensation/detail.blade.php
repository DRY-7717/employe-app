@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Compensation User</h3>
                    <p class="text-subtitle text-muted">Halaman detail gaji karyawan</p>
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
            <div class="card">
                <form action="" class="form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="position_id">Posisi</label>
                                    <input type="text" id="position_id" class="form-control"
                                        placeholder="Input tunjangan kesehatan" name="position_id"
                                        value="{{ $userSalary->user->positions()->first()->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="salary">Gaji</label>
                                    <input type="text" id="salary" class="form-control" placeholder="Input gaji pokok"
                                        name="salary"
                                        value="Rp.{{ number_format($userSalary->salary->salary, '0', '.', '.') }}" disabled>

                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="health_allowance">Tunjangan Kesehatan</label>
                                    <input type="text" id="health_allowance" class="form-control "
                                        placeholder="Input tunjangan kesehatan" name="health_allowance"
                                        value="Rp.{{ number_format($userSalary->salary->health_allowance, '0', '.', '.') }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="education_allowance">Tunjangan Pendidikan</label>
                                    <input type="text" id="education_allowance" class="form-control"
                                        placeholder="Input tunjangan pendidikan" name="education_allowance"
                                        value="Rp.{{ number_format($userSalary->salary->education_allowance, '0', '.', '.') }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="transportation_allowance">Tunjangan Transportasi</label>
                                    <input type="text" id="transportation_allowance" class="form-control "
                                        placeholder="Input tunjangan transportasi" name="transportation_allowance"
                                        value="Rp.{{ number_format($userSalary->salary->transportation_allowance, '0', '.', '.') }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <a href="/dashboard/payroll/user/compensation" class="btn btn-primary me-1 mb-1">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
