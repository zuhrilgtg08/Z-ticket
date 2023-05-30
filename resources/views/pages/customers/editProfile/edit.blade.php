@extends('layouts.frontend.mainFrontend')
@section('content')
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 mt-5">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show col-md-7" role="alert">
                            {{ session('success') }} 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show col-md-7" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card shadow h-100 rounded">
                        <div class="card-body">
                            <h2 class="fw-normal">Edit Data Account Profile</h2>
                            <form action="{{ route('update.profile', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                                <div class="row justify-content-center mt-5">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                                                value="{{ old('username', $dataUsers->username) }}" id="username" required autofocus/>
                                            @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">No. Telpon</label>
                                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ old('phone', $dataUsers->phone) }}" id="phone" required />
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Account</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email', $dataUsers->email) }}" id="email" required />
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="profile" class="form-label">Image Profile</label>
                                            <input type="hidden" value="{{ $dataUsers->profile }}" name="oldProfile">
                                            @if ($dataUsers->profile)
                                                <img src="{{ asset('storage/' . $dataUsers->profile) }}" alt="profile" class="img-fluid d-block m-2 sm-2 preview" 
                                                    width="100"/>
                                            @else
                                                <img src="{{ asset('assets/img/users.png') }}" alt="profile" class="img-fluid sm-2 d-block m-2 preview" 
                                                    width="100"/>
                                            @endif
                                            <input type="file" class="form-control-file @error('profile') is-invalid @enderror" name="profile"
                                                value="{{ old('profile', $dataUsers->profile) }}" id="profile" required onchange="onchangeImage()"/>
                                            @error('profile')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center mx-auto mt-4">
                                    <button type="submit" class="btn btn-success col-md-6"><i class="fas fa-fw fa-save"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function onchangeImage() {
            const imgPreview = document.querySelector('.preview');
            const inputProfile = document.querySelector('#profile');
            imgPreview.style.display = 'block';
    
            const oFReader = new FileReader();
            oFReader.readAsDataURL(inputProfile.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection