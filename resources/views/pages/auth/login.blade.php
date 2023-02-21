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
        height: 100%;
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
        <div class="col-lg-10 mx-auto mb-3">
            <h2 class="text-indigo-100">Welcome! Please Login</h2>
        </div>
        <div class="col-md-4 mx-auto text-start">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>

    <div class="row d-flex justify-content-center align-items-center h-100 my-5">
        <div class="col-lg-6 col-xl-5">
            <img src="{{ asset('assets/img/ticket.gif') }}" class="img-fluid rounded" alt="logo-image" />
        </div>
        <div class="col-lg-6 col-xl-4 offset-xl-1 mb-5">
            <form action="{{ route('login.process') }}" method="POST" class="d-inline">
                @csrf
                <!-- Email input -->
                <div class="mb-3">
                    <label class="form-label @error('email') is-invalid @enderror" for="email">Email : </label>
                    <input type="email" id="email" class="form-control form-control-lg" placeholder="Akun Email"
                        autocomplete="off" autofocus name="email" />
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="mb-3">
                    <label class="form-label" for="password">Password : </label>
                    <input type="password" id="password" class="form-control form-control-lg" placeholder="Password"
                        name="password" />
                </div>

                <div class="text-center text-center mt-3 pt-2">
                    <button type="submit" class="btn btn-primary" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                        Login
                    </button>
                    <h6 class="fw-normal mt-2 pt-1 mb-0">Belum punya akun?
                        <a href="{{ url('register') }}" class="link-danger text-decoration-none fw-bold">Daftar
                            Disini!</a>
                    </h6>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection