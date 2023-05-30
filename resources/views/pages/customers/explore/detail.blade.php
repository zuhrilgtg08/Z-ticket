@extends('layouts.frontend.mainFrontend')
@section('style')
    <style>
         .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            display: none;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:25px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        .not-allowed {
            cursor: not-allowed;
        }
    </style>
@endsection
@section('content')
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3 shadow" style="max-width: 22rem;">
                        @if ($detail->image_hotel)
                            <img class="card-img-top img-fluid rounded" src="{{ asset('storage/'. $detail->image_hotel) }}" alt="Card image"
                                id="product-detail" />
                        @else
                            <img class="card-img-top img-fluid rounded" src="{{ asset('assets/img/blank-hotel.webp') }}" alt="Card image"
                                id="product-detail" />
                        @endif
                    </div>
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <h2>{{ $detail->nama_hotel }}</h2>
                                </div>
                                <div class="col-md-3 float-end">
                                    <a href="/explore" class="btn btn-dark btn-sm">
                                        <i class="fas fa-fw fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <p class="h3 py-2">@harga($detail->harga_hotel) 
                                @if ($detail->harga_hotel > 2000000)
                                    <p class="fst-italic"><span class="badge bg-warning text-dark">Premium</span></p>
                                @endif
                            </p>
                            <p class="py-2">
                                <span class="list-inline-item text-dark">Rating {{ $sumRating }} <i class="fa fa-star text-warning"></i> 
                                    | {{ $comments }} Comments</span>
                            </p>
                            <h6>Description:</h6>
                            <p>{!! $detail->deskripsi_hotel !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
