@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Confrim Leave Request</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengkonfrimasi pengajuan cuti karyawan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Confrim Leave Request
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <form action="/dashboard/leave/confirm/{{ $leaverequest->id }}" method="POST" class="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="start_date">Awal Tanggal Cuti</label>
                                    <input type="date" id="start_date" class="form-control"
                                        placeholder="Input awal tanggal cuti" name="start_date"
                                        value="{{ $leaverequest->start_date }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="end_date">Akhir Tanggal Cuti</label>
                                    <input type="date" id="end_date" class="form-control"
                                        placeholder="Input akhir tanggal cuti" name="end_date"
                                        value="{{ $leaverequest->end_date }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="reason">Alasan</label>
                                    <textarea class="form-control " id="reason" rows="3" name="reason" disabled>{{ old('reason', $leaverequest->reason) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="reason">Bukti</label>
                                    @if ($leaverequest->proof)
                                        <img src="{{ asset('storage/' . $leaverequest->proof) }}"
                                            class=" img-preview d-block img-fluid rounded mb-2 "
                                            style="width: 800px; height: 500px;" alt="">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between mt-3">
                                <div class="">
                                    <button type="submit" name="approve" value="Approve"
                                        class="btn btn-success me-1 mb-1">Approve</button>
                                    <button type="submit" name="failed" value="Failed"
                                        class="btn btn-danger me-1 mb-1">Failed</button>
                                </div>

                                <a href="/dashboard/leave/confirm" class="btn btn-primary me-1 mb-1">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

