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

@section('content-admin-profile')
    <section class="section profile">
        @if (session()->has('success'))
            <div class="alert alert-success col-md-5 alert-dismissible fade show" role="alert">
                {{ session('success') }} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if (session()->has('error'))
            <div class="alert alert-danger col-md-5 alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if (auth()->user()->role == 1 || auth()->user()->profile)
                        <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="Profile" class="rounded-circle">
                        @else
                        <img src="{{ asset('assets/img/users.png') }}" alt="Profile" class="rounded-circle">
                        @endif
                        <h4 class="my-3 font-normal">{{ auth()->user()->username }}</h4>
                        <h5 class="font-normal">Administrator</h5>
                    </div>
                </div>
            </div>
    
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>
    
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    Edit Profile
                                </button>
                            </li>
    
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque
                                    temporibus. Tempora libero
                                    non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet
                                    perspiciatis odit. Fuga sequi sed
                                    ea saepe at unde.</p>
                                <h5 class="card-title">Profile Details</h5>
    
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Username</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->username }}</div>
                                </div>
    
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                    <div class="col-lg-9 col-md-8">Administrator</div>
                                </div>
    
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->phone }}</div>
                                </div>
    
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                </div>

                            </div>
                            
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form action="{{ route('dashboard.updateProfile', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="profile" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                                <!-- hidden profile -->
                                                <input type="hidden" name="profileLama" value="{{ $admin->profile }}">
                                                @if ($admin->profile)
                                                    <img src="{{ asset('storage/' . $admin->profile )}}" class="profile-preview img-fluid rounded">
                                                @else
                                                    <img class="profile-preview img-fluid rounded" alt="Profile">
                                                @endif
                                            <div class="pt-2">
                                                <input type="file" class="form-control-file" @error('profile') is-invalid @enderror id="profile" name="profile"
                                                    onchange="fotoProfile()">
                                                @error('profile')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" id="username"
                                                value="{{ old('username', $admin->username) }}" required />
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" id="email"
                                                value="{{ old('email', $admin->email) }}" required />
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">No. Handphone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="number" id="phone"
                                                value="{{ old('phone', $admin->phone) }}" min="1" required />
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <form action="{{ route('dashboard.changePassword', $admin->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                                id="currentPassword">
                                            @error('current_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                                id="newPassword">
                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="row mb-3">
                                        <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" 
                                                id="confirmPassword">
                                            @error('confirm_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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