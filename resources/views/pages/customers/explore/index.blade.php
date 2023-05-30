@extends('layouts.frontend.mainFrontend')
@section('style')
    
@endsection
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg">
                <form action="{{ url('/explore') }}" method="GET">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-6 mb-4">
                            <div class="input-group shadow">
                                <input type="text" name="cari_hotel" value="{{ request('cari_hotel') }}" class="form-control" placeholder="Cari Disini...">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-fw fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    @if ($datas->count())
                        @foreach ($datas as $data)
                            <div class="col-md-4 mt-4">
                                <div class="card mb-4 product-wap rounded-0 shadow h-100">
                                    <div class="card rounded-0">
                                        @if ($data->image_hotel)
                                            <img class="card-img rounded-0" src="{{ asset('storage/' . $data->image_hotel) }}" height="300px">
                                        @else
                                            <img class="card-img rounded-0" src="{{ asset('assets/img/blank-hotel.webp') }}" height="300px">
                                        @endif
                                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                            <a class="btn btn-success text-white" href="{{ route('explore.detail', $data->id) }}">
                                                <i class="fas fa-fw fa-info-circle"></i> Detail</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-7 mt-1">
                                                <h3 class="h3 text-center text-dark">{{ $data->nama_hotel }}</h3>
                                            </div>
                                            @if ($data->harga_hotel > 2000000)
                                                <div class="col-md-5">
                                                    <p class="text-center fst-italic"><span class="badge bg-warning text-dark">Premium</span></p>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-disabled text-center">{{ $data->excerpt }}</p>
                                        <h6 class="text-center mb-0 text-danger">@harga($data->harga_hotel)</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-6 mt-3 m-auto text-center">
                            <h4 class="mb-3 text-primary">Maaf, Kamar Tidak Tersedia!.</h4>
                        </div>
                    @endif
                </div>
                <div class="row mt-4 pagination pagination-lg justify-content-end">
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection