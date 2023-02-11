@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.account'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Account Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item"><a href="/data_account">Account Users</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6">
            <div class="card shadow-inner border-0">
                <div class="card-header mt-3">
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-9">
                            <h4 class="text-black-50">Detail Users</h4>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary btn-sm float-end" href="{{ route('data_account.index') }}">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3 mx-auto">
                        <div class="col-md">
                            <div class="mb-3">
                                @if ($pengguna->profile)
                                    <img src="{{ asset('storage/'. $pengguna->profile) }}" alt="profile"
                                        class="img-fluid d-block m-auto img-profile">
                                @else
                                    <img src="{{ asset('assets/img/users.png') }}" alt="profile" 
                                        class="img-fluid d-block m-auto img-profile" width="250">
                                @endif
                            </div>
                            <div class="mb-3">
                                <div class="text-body text-gray-900">
                                    <h5 class="text-gray-900 text-normal">Username : 
                                    <span class="text-danget text-bold">{{ $pengguna->username }}</span></h5>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900 text-normal">Email :
                                    <span class="text-success">{{ $pengguna->email }}</span>
                                </h5>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900"> No. Handphone :
                                    <span class="text-danger text-normal">{{ $pengguna->phone ?? '-' }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection