@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Leave Request</h3>
                    <p class="text-subtitle text-muted">Halaman untuk karyawan mengajukan cuti</p>
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
            <div class="card">
                <form action="/dashboard/leave/request" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="start_date">Awal Tanggal Cuti</label>
                                    <input type="date" id="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        placeholder="Input awal tanggal cuti" name="start_date"
                                        value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="end_date">Akhir Tanggal Cuti</label>
                                    <input type="date" id="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        placeholder="Input akhir tanggal cuti" name="end_date"
                                        value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="reason">Alasan</label>
                                    <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" rows="3" name="reason"></textarea>
                                    @error('reason')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="reason">Bukti</label>

                                    <img class=" img-preview d-none  img-fluid rounded mb-2 "
                                        style="width: 800px; height: 500px;" alt="">

                                    <input type="file" class="form-control @error('proof') is-invalid @enderror"
                                        id="customFile" name="proof" onchange="previewImage()" placeholder="">
                                    @error('proof')
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

@push('script')
    <script>
        function previewImage() {
            const imagePreview = document.querySelector('.img-preview');
            const image = document.querySelector('#customFile');
            const ofReader = new FileReader();


            imagePreview.classList.replace('d-none', 'd-block')

            ofReader.readAsDataURL(image.files[0]);
            ofReader.onload = function(ofREvent) {
                imagePreview.src = ofREvent.target.result;
            }
        }
    </script>
@endpush
