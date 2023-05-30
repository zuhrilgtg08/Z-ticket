@extends('layouts.dashboard.mainDashboard', ['isActive' => 'menu.reviews'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Reviews</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/data_reviews">Reviews</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="row justify-content-center mb-4">
        <div class="col-lg-7">
            <div class="card shadow-inner border-0">
                <div class="card-header mt-3">
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-9">
                            <h2 class="text-black-50">Detail Reviews Hotel</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary btn-sm float-end" href="{{ route('data_reviews.index') }}">
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
                                @if ($detail->image_hotel)
                                <img src="{{ asset('storage/'. $detail->image_hotel) }}" alt="gambar"
                                    class="img-thumbnail img-fluid d-block">
                                @else
                                <img src="{{ asset('assets/img/blank-hotel.webp') }}" alt="gambar"
                                    class="img-thumbnail img-fluid d-block">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card-text text-gray-900">
                            {!! $detail->deskripsi_hotel !!}
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama Hotel : <span
                                class="badge text-bg-dark">{{ $detail->nama_hotel }}</span></li>
                        <li class="list-group-item">Harga : <span
                                class="badge text-bg-success">@harga($detail->harga_hotel)</span></li>
                        <li class="list-group-item">Golongan Tiket : <span
                                class="text-danger fw-bolder">{{ $detail->tiket->nama_tiket }}</span></li>
                        <li class="list-group-item">Kode Hotel: <span
                                class="badge text-bg-primary">{{ $detail->kode_hotel }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-inner border-0">
                <div class="card-header mt-3">
                    <h4 class="text-black-50">List Komen & Rating</h4>
                </div>
                @if (!$dataUsers->isEmpty())
                    @foreach ($dataUsers as $item)
                        <div class="border border-1 border-dark mb-2"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->user->username }}</h5>
                            <p class="card-text">{{ $item->komentar }} | {{ $item->nilai_rating }}
                                <i class="bi bi-star-fill text-warning"></i>
                            </p>
                        </div>
                    @endforeach
                @else
                    <h5 class="card-title">Komentar & Rating Tidak ada!</h5>
                @endif
            </div>
        </div>
    </div>
@endsection