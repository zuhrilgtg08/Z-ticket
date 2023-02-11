@extends('layouts.dashboard.mainDashboard', ['isActive' => 'dashboard'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Profile Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Profile</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-4">
            @if (session()->has('success'))
                <div class="alert alert-success col-md-6 alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        
            @if (session()->has('error'))
                <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-inner border-0">
                <div class="card-header mb-3">
                    <h2 class="text-black-50">Edit Profile</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.updateProfile', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username : </label>
                                    <input class="form-control @error('username') is-invalid @enderror" name="username"
                                        type="text" id="username" value="{{ old('username', $admin->username) }}" required />
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email : </label>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        type="email" id="email" value="{{ old('email', $admin->email) }}" required />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">No. Handphone : </label>
                                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="number" id="phone"
                                        value="{{ old('phone', $admin->phone) }}" min="1" required />
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="profile" class="form-label">Foto Profile : </label>
                                    <!-- hidden profile -->
                                    <input type="hidden" name="profileLama" value="{{ $admin->profile }}">
                                    @if ($admin->profile)
                                        <img src="{{ asset('storage/' . $admin->profile )}}"
                                            class="profile-preview img-fluid mb-3 sm-2 d-block">
                                    @else
                                        <img class="profile-preview img-fluid mb-3 sm-2">
                                    @endif
    
                                    <input type="file" class="form-control-file" @error('profile') is-invalid @enderror
                                        id="profile" name="profile" onchange="fotoProfile()">
                                    @error('profile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="float-end mt-2">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function fotoProfile() {
                const profileInput = document.querySelector('#profile');
                const profilePreview = document.querySelector('.profile-preview');
                profilePreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(profileInput.files[0]);

                oFReader.onload = function(oFREvent) {
                    profilePreview.src = oFREvent.target.result;
                }
            }
    </script>
@endsection