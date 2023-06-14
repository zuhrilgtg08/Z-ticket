@extends('layouts.frontend.mainFrontend')
@section('content')
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($tikets->take(3) as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="container">
                        <div class="row p-5">
                            <div class="mx-auto col-lg-6 order-lg-last">
                                @if ($item->image)
                                    <img class="img-fluid" src="{{ asset('storage/' . $item->image) }}" alt="tiket-img" width="500" />
                                @else
                                    <img class="img-fluid" src="{{ asset('assets/img/blank-tiket.webp') }}" alt="tiket-img" />
                                @endif
                            </div>
                            
                            <div class="col-lg-6 mb-0 d-flex align-items-center">
                                <div class="text-align-left">
                                    <h1 class="h1">{{ $item->nama_tiket }}</h1>
                                    <h3 class="h2">{{ $item->excerpt }}</h3>
                                    <p>{!! $item->deskripsi_tiket !!}</p>
                                    <a class="btn btn-primary" href="{{ route('homeTiket.detail', $item->id) }}">
                                        <i class="fas fa-fw fa-info-circle"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>

    <section class="bg-default" style="background-color: #fff">
        <div class="container py-3">
            <div class="row text-center py-5">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Cari Data Terbaru</h1>
                    <form action="/home" method="GET">
                        @csrf

                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                
                        @if (request('penerbit'))
                            <input type="hidden" name="kota" value="{{ request('kota') }}">
                        @endif
                
                        @if (request('provinsi'))
                            <input type="hidden" name="provinsi" value="{{ request('provinsi') }}">
                        @endif

                        <div class="input-group shadow">
                            <input type="text" class="form-control" name="cari" placeholder="Cari Data..." value="{{ request('cari') }}">
                            <button class="btn btn-primary rounded" type="submit" id="cari-button">
                                <i class="fas fa-fw fa-search"></i>
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if ($data->count())
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card rounded h-100 shadow">
                            <a href="#">
                                @if ($data[0]->image)
                                    <img src="{{ asset('storage/'. $data[0]->image) }}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('assets/img/blank-tiket.webp') }}" class="card-img-top" alt="...">
                                @endif
                            </a>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li class="text-success text-right fw-bold">@harga($data[0]->harga)</li>
                                </ul>
                                <h2 class="fw-normal text-bg-dark">{{ $data[0]->nama_tiket }}</h2>
                                <p class="card-text">
                                    {!! $data[0]->excerpt !!}
                                </p>
                                <ul class="list-unstyled">
                                    <li>Category : <span class="badge bg-warning text-dark">{{ $data[0]->category->nama_kategori }}</span></li>
                                    <li>Provinsi : <span class="badge bg-success">{{ $data[0]->provinsi->nama_provinsi }}</span></li>
                                    <li>Kota/Kabupaten : <span class="badge bg-info">{{ $data[0]->kota->nama_kota }}</span></li>
                                </ul>
                                <a class="btn btn-sm btn-primary" href="{{ route('homeTiket.detail', $data[0]->id) }}"><i class="fas fa-fw fa-info-circle"></i> Detail</a>
                                <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="tiket_id" value="{{ $data[0]->id }}" />
                                    <input type="hidden" id="quantity" name="quantity" value="1" min="1" max="{{ $data[0]->stok }}"/>
                                    <button type="{{ (auth()->user()) ? 'submit' : 'disabled' }}"
                                        class="btn btn-danger btn-sm {{ (auth()->user()) ? '' : 'd-none' }}"
                                        style="{{ (auth()->user()) ? '' : 'cursor: not-allowed !important; pointer-events: auto;' }}">
                                        <i class="fas fa-fw fa-money-bill"></i>
                                        Add To Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @foreach($data->skip(1) as $item)
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card rounded h-100 shadow">
                                <a href="#">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="...">
                                    @else
                                        <img src="{{ asset('assets/img/blank-tiket.webp') }}" class="card-img-top" alt="...">
                                    @endif
                                </a>
                                <div class="card-body">
                                    <ul class="list-unstyled d-flex justify-content-between">
                                        <li class="text-success text-right fw-bold">@harga($item->harga)</li>
                                    </ul>
                                    <h2 class="fw-normal text-bg-dark">{{ $item->nama_tiket }}</h2>
                                    <p class="card-text">
                                        {!! $item->excerpt !!}
                                    </p>
                                    <ul class="list-unstyled">
                                        <li>Category : <span class="badge bg-warning text-dark">{{ $item->category->nama_kategori }}</span></li>
                                        <li>Provinsi : <span class="badge bg-success">{{ $item->provinsi->nama_provinsi }}</span></li>
                                        <li>Kota/Kabupaten : <span class="badge bg-danger">{{ $item->kota->nama_kota }}</span></li>
                                    </ul>
                                    <a class="btn btn-sm btn-primary" href="{{ route('homeTiket.detail', $item->id) }}"><i class="fas fa-fw fa-info-circle"></i> Detail</a>
                                    <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="tiket_id" value="{{ $item->id }}" />
                                        <input type="hidden" id="quantity" name="quantity" value="1" min="1" max="{{ $item->stok }}" />
                                        <button type="{{ (auth()->user()) ? 'submit' : 'disabled' }}"
                                            class="btn btn-danger btn-sm {{ (auth()->user()) ? '' : 'd-none' }}"
                                            style="{{ (auth()->user()) ? '' : 'cursor: not-allowed !important; pointer-events: auto;' }}">
                                            <i class="fas fa-fw fa-money-bill"></i>
                                            Add To Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-6 mt-3 m-auto text-center ">
                        <p class="fs-4 h3 mb-3">Maaf, Data Tidak Tersedia!.</p>
                    </div>
                @endif
            </div>
            <div div="row bg-primary">
                {!! $data->links() !!}
            </div>
        </div>
    </section>
@endsection
