@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.tiket'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Tiket</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item"><a href="/data_tiket">Tiket</a></li>
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
                            <h2 class="text-black-50">Detail Tiket</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary btn-sm float-end" href="{{ route('data_tiket.index') }}">
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
                                @if ($tiket->image)
                                    <img src="{{ asset('storage/'. $tiket->image) }}" alt="sampul" class="img-thumbnail img-fluid d-block">
                                @else
                                    <img src="{{ asset('assets/img/blank-tiket.webp') }}" alt="sampul" class="img-thumbnail img-fluid d-block">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card-text text-gray-900">
                            {!! $tiket->deskripsi_tiket !!}
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Harga : <span class="badge text-bg-success">@harga($tiket->harga)</span></li>
                        <li class="list-group-item">Stok : <span class="badge text-bg-dark">{{ $tiket->stok }}</span></li>
                        <li class="list-group-item">Provinsi : <span class="text-danger fw-bolder">{{ $tiket->provinsi->nama_provinsi }}</span></li>
                        <li class="list-group-item">Kota : <span class="badge text-bg-primary">{{ $tiket->kota->nama_kota }}</span></li>
                        <li class="list-group-item">Kategori : <span class="badge text-bg-warning">{{ $tiket->category->nama_kategori }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection