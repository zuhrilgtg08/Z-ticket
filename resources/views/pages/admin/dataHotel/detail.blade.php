@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.hotel'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Hotel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item"><a href="/data_hotel">Hotel</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-inner border-0">
                <div class="card-header mt-3">
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-9">
                            <h2 class="text-black-50">Detail Hotel</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary btn-sm float-end" href="{{ route('data_hotel.index') }}">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-lg-8 col-md-8">
                            <div class="mb-3">
                                @if ($hotel->image_hotel)
                                    <img src="{{ asset('storage/'. $hotel->image_hotel) }}" alt="gambar" class="img-thumbnail img-fluid d-block">
                                @else
                                    <img src="{{ asset('assets/img/blank-hotel.webp') }}" alt="gambar" class="img-thumbnail img-fluid d-block">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card-text text-gray-900">
                            {!! $hotel->deskripsi_hotel !!}
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama Hotel : <span class="badge text-bg-dark">{{ $hotel->nama_hotel }}</span></li>
                        <li class="list-group-item">Harga : <span class="badge text-bg-success">@harga($hotel->harga_hotel)</span></li>
                        <li class="list-group-item">Golongan Tiket : <span class="text-danger fw-bolder">{{ $hotel->tiket->nama_tiket }}</span></li>
                        <li class="list-group-item">Kode Hotel: <span class="badge text-bg-primary">{{ $hotel->kode_hotel }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection