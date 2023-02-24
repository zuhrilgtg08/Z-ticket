@extends('layouts.frontend.mainFrontend')
@section('content')
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        @if ($detail->image)
                            <img class="card-img img-fluid" src="{{ asset('storage/'. $detail->image) }}" alt="Card image" id="product-detail">
                        @else
                            <img class="card-img img-fluid" src="{{ asset('assets/img/logo-ticket.jpg') }}" alt="Card image" id="product-detail">
                        @endif
                    </div>
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ $detail->nama_tiket }}</h2>
                            <p class="h3 py-2">@harga($detail->harga)</p>
                            <p class="py-2">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                            </p>
                            <h6>Description:</h6>
                            <p>{!! $detail->deskripsi_tiket !!}</p>
    
                            <form action="" method="GET">
                                <div class="row g-3 align-items-center mb-3">
                                    <div class="col-auto">
                                        <label for="jumlah" class="col-form-label">Jumlah : </label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" id="jumlah" name="jumlah" 
                                            value="1" min="1" max="{{ $detail->stok }}" class="form-control border-2 shadow text-center">
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-md-4">
                                        <a href="/home" class="btn btn-dark btn-sm"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
                                    </div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-danger float-end" name="submit">
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
                <h4>Data Kamar Hotel Terkait</h4>
            </div>
    
            <div id="carousel-related-product">
                @foreach ($hotel as $key => $item)
                    <div class="p-2 pb-3">
                        <div class="product-wap card rounded-0">
                            <div class="card rounded-0">
                                @if ($item->image_hotel)
                                    <img class="card-img rounded-0 img-fluid" src="{{ asset('storage/' . $item->image_hotel) }}">
                                @else
                                    <img class="card-img rounded-0 img-fluid" src="{{ asset('assets/img/blank-hotel.webp') }}">
                                @endif
                                <div
                                    class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white" href="#"><i
                                                    class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="#"><i
                                                    class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="#"><i
                                                    class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="shop-single.html" class="h3 text-decoration-none">Red Clothing</a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>M/L/X/XL</li>
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul>
                                <p class="text-center mb-0">$20.00</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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