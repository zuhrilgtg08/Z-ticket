@extends('layouts.frontend.mainFrontend')
@section('style')
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    
        .h-custom {
            height: calc(100% - 73px);
        }
    
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid h-custom my-5">
        <div class="row mb-3 text-center">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-primary">Registrasi Dulu!</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-3">
            <div class="col-md-5">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <form action="{{ route('register.process') }}" method="POST">
                            @csrf
                            <!-- username input -->
                            <div class="mb-3">
                                <label class="form-label" for="username">Username : </label>
                                <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" 
                                    placeholder="Username" autocomplete="off" autofocus 
                                    name="username" required value="{{ old('username') }}"/>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
        
                            <!--email input -->
                            <div class="mb-3">
                                <label class="form-label" for="email">Email : </label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                    placeholder="Akun Email" autocomplete="off" 
                                    name="email" required value="{{ old('email') }}"/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
            
                            <!-- Password input -->
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Buat Password : </label>
                                <input type="password" id="newPassword" class="form-control @error('newPassword') is-invalid @enderror"
                                name="newPassword" required placeholder="Buat Password"/>
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- confirm Password input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Konfirmasi Password : </label>
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required placeholder="Konfirmasi Password"/>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">
                                    Register
                                </button>
                                <h6 class="fw-normal mt-2 pt-1 mb-0">Sudah punya akun?
                                    <a href="{{ url('login') }}" class="link-danger text-decoration-none fw-bold">login Disini!</a>
                                </h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection