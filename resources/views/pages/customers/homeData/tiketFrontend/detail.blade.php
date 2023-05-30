@extends('layouts.frontend.mainFrontend')
@section('content')
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3 shadow" style="max-width: 22rem;">
                        @if ($detail->image)
                            <img class="card-img img-fluid rounded" src="{{ asset('storage/'. $detail->image) }}" alt="Card image" id="product-detail">
                        @else
                            <img class="card-img img-fluid rounded" src="{{ asset('assets/img/blank-tiket.webp') }}" alt="Card image" id="product-detail">
                        @endif
                    </div>
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body shadow border-0 rounded">
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <h2>{{ $detail->nama_tiket }}</h2>
                                </div>
                                <div class="col-md-4">
                                    <a href="/home" class="btn btn-dark btn-sm float-end rounded"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <p class="h3 py-2">Harga : <span class="badge bg-danger">@harga($detail->harga)</span></p>
                            <h6>Description:</h6>
                            <p>{!! $detail->deskripsi_tiket !!}</p>
                            <form action="" method="POST">
                                <div class="row g-3 align-items-center mb-3">
                                    <div class="col-md-2">
                                        <label for="jumlah" class="col-form-label">Jumlah : </label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" id="jumlah" name="jumlah" 
                                            value="1" min="1" max="{{ $detail->stok }}" 
                                                class="form-control text-center shadow rounded border-secondary border-1">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="{{ (auth()->user()->role == 1) ? 'button' : 'submit' }}" class="btn btn-danger {{ (auth()->user()->role == 1) ? 'disabled' : '' }}"
                                            style="{{ (auth()->user()->role == 1) ? 'cursor: not-allowed !important; pointer-events: auto;' : '' }}" >
                                            <i class="fas fa-fw fa-money-bill"></i>
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Kamar Hotel Terkait</h4>
            </div>

            @if ($hotel->count())
                <div id="carousel-related-product">
                    @foreach ($hotel as $key => $item)
                        <div class="p-2 pb-3">
                            <div class="product-wap card rounded-0 shadow">
                                <div class="card rounded-0">
                                    @if ($item->image_hotel)
                                        <img class="rounded-0 card-img" src="{{ asset('storage/' . $item->image_hotel) }}" height="300px">
                                    @else
                                        <img class="rounded-0 card-img" src="{{ asset('assets/img/blank-hotel.webp') }}" height="300px">
                                    @endif
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <a href="{{ route('homeHotel.detail', $item->id) }}" class="btn btn-primary btn-lg text-white">
                                            <i class="fas fa-fw fa-info-circle text-white"></i> Read More</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="fw-normal text-center">{{ $item->nama_hotel }}</h4>
                                    <p class="text-dark text-center">{{ $item->excerpt }}</p>
                                    <p class="text-center mb-0 text-danger fw-bold">@harga($item->harga_hotel)</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-md-6 mt-3 m-auto text-center ">
                    <p class="fs-4 h3 mb-3">Maaf, Kamar Tidak Tersedia!.</p>
                </div>
            @endif
    
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#carousel-related-product').slick({
                infinite: true,
                arrows: false,
                slidesToShow: 4,
                slidesToScroll: 3,
                dots: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 3
                        }
                    }
                ]
            });
    </script>
@endsection