@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.reviews'])
@section('content-dashboard')
    <h2 class="h2 mb-3 text-black-50">Detail Reviews Tiket</h2>

    <div class="row justify-content-center">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-inner border-0">
                <div class="card-body">
                    <a class="btn btn-secondary btn-sm mb-4" href="{{ route('data_reviews.index') }}">
                        <i class="fas fa-fw fa-arrow-left"></i>
                        Kembali
                    </a>
    
                    <div class="row mb-3 mx-auto">
                        <div class="col-md">
                            <div class="mb-3">
                                @if ($tiket->image)
                                    <img src="{{ asset('storage/'. $tiket->image) }}" alt="sampul"
                                        class="img-fluid d-block m-auto img-profile">
                                @else
                                    <img src="{{ asset('assets/img/blank-tiket.webp') }}" alt="sampul"
                                        class="img-fluid d-block m-auto img-profile" width="250">
                                @endif
                            </div>
                            <div class="mb-3">
                                <div class="text-body text-gray-900">
                                    <h5 class="text-gray-900 text-normal">Kategori :
                                        <span class="text-danget text-bold">{{ $tiket->category->nama_kategori }}</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="text-body text-gray-900">
                                    <h5 class="text-gray-900 text-normal">Nama Tiket :
                                        <span class="text-danget text-bold">{{ $tiket->nama_tiket }}</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900 text-normal">Stok Tiket :
                                    <span class="text-success">{{ $tiket->stok }}</span>
                                </h5>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900"> Harga Tiket :
                                    <span class="text-danger text-normal">@harga($tiket->harga)</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection