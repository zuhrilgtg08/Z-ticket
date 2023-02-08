@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.tiket'])
@section('content-dashboard')
    <h2 class="h2 mb-3 text-black-50">Detail Data Tiket</h2>

    <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-inner border-0">
                <div class="card-body">
                    <a class="btn btn-secondary btn-sm mb-4" href="{{ route('data_tiket.index') }}">
                        <i class="fas fa-fw fa-arrow-left"></i>
                        Kembali
                    </a>
                    
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="mb-3">
                                @if ($tiket->image)
                                    <img src="{{ asset('storage/'. $tiket->image) }}" alt="sampul" class="img-thumbnail img-fluid d-block">
                                @else
                                    <img src="{{ asset('assets/img/blank-tiket.webp') }}" alt="sampul" class="img-thumbnail img-fluid d-block">
                                @endif
                            </div>
                            <div class="mb-3">
                                <div class="text-body text-gray-900">
                                    {!! $tiket->deskripsi_tiket !!}
                                </div>
                            </div>
                            <div class="mb-3">
                                <h4 class="text-gray-900 text-normal">Harga : 
                                    <span class="text-success">@harga($tiket->harga)</span>
                                </h4>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900 text-normal"> Stok : 
                                    <span class="text-dark">{{ $tiket->stok }} <i class="fas fa-fw fa-cubes"></i></span>
                                </h5>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900"> Provinsi Asal : 
                                    <span class="text-danger text-normal">{{ $tiket->provinsi->nama_provinsi }}</span>
                                </h5>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900"> Kota Asal :
                                    <span class="text-danger text-normal">{{ $tiket->kota->nama_kota }}</span>
                                </h5>
                            </div>
                            <div class="mb-3">
                                <h5 class="text-gray-900"> Kategori :
                                    <span class="text-danger text-normal">{{ $tiket->category->nama_kategori }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection