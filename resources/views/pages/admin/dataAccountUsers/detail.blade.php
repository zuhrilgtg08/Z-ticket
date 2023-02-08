@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.account'])
@section('content-dashboard')
    <h2 class="h2 mb-3 text-black-50">Detail Data Pengguna</h2>

    <div class="row justify-content-center">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-inner border-0">
                <div class="card-body">
                    <a class="btn btn-secondary btn-sm mb-4" href="{{ route('data_account.index') }}">
                        <i class="fas fa-fw fa-arrow-left"></i>
                        Kembali
                    </a>

                    <div class="row mb-3 mx-auto">
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