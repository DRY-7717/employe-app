@extends('template.main')


@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>My Profile</h3>
                    <p class="text-subtitle text-muted">Halaman untuk memanajemen profile</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            @if (!auth()->user()->profile)
                <div class="alert alert-light-warning color-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                    Silahkan isi profile anda terlebih dahulu!
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-light-success color-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="/dashboard/profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data"
                        class="form">
                        @csrf
                        @method('put')
                        <div class="card-header text-center">
                            @if (auth()->user()->profile?->img_profile)
                                <img src="{{ asset('storage/' . auth()->user()->profile->img_profile) }}"
                                    class=" img-preview  img-fluid rounded-circle mb-3  "
                                    style="width: 150px; height: 150px; object-fit: cover; object-position: top;"
                                    alt="">

                                <p class="m-0 p-0 text-light fw-semibold">{{ auth()->user()->positions->first()->name ?? '-' }}</p>
                            @else
                                <img src="/assets/static/images/faces/2.jpg"
                                    class=" img-preview  img-fluid rounded-circle mb-3 "
                                    style="width: 150px; height: 150px; object-fit: cover; object-position: top;"
                                    alt="">
                                <p class="m-0 p-0 text-light fw-semibold">{{ auth()->user()->positions->first()->name ?? '-' }}</p>
                            @endif

                            <!-- File uploader with image preview -->
                            <div class="row">
                                <div class="col-lg-4 mx-auto">
                                    <input type="file"
                                        class="form-control mt-2 @error('img_profile') is-invalid @enderror" id="customFile"
                                        name="img_profile" onchange="previewImage()" placeholder="">
                                    @error('img_profile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control "
                                            placeholder="Input nama anda" name="name" value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="Input email " name="email"
                                            value="{{ auth()->user()->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="no_hp">No. Handphone</label>
                                        <input type="text" id="no_hp"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            placeholder="Input nomor handphone anda" name="no_hp"
                                            value="{{ old('no_hp', auth()->user()->profile->no_hp ?? '') }}">
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" id="tgl_lahir"
                                            class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
                                            placeholder="Input tanggal lahir anda"
                                            value="{{ old('tgl_lahir', auth()->user()->profile->tgl_lahir ?? '') }}">
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class=" col-12">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label mb-0">Address</label>
                                        <textarea class="form-control mt-1 @error('address') is-invalid @enderror" id="address" rows="3" name="address">{{ old('address', auth()->user()->profile->address ?? '') }}</textarea>

                                        @error('address')
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
