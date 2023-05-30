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
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

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
                                <div class="col-md-9">
                                    <h2>{{ $detail->nama_hotel }}</h2>
                                </div>
                                <div class="col-md-3 float-end">
                                    <a href="/home" class="btn btn-dark btn-sm">
                                        <i class="fas fa-fw fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <p class="h3 py-2">@harga($detail->harga_hotel)</p>
                            <p class="py-2">
                                <span class="list-inline-item text-dark">Rating {{ $sumRating }} <i class="fa fa-star text-warning"></i> 
                                    | {{ $comments }} Comments</span>
                            </p>
                            <h6>Description:</h6>
                            <p>{!! $detail->deskripsi_hotel !!}</p>
    
                            <div class="row justify-content-between">
                                <div class="col-md-8">
                                    <button type="button" class="btn btn-primary {{ (auth()->user()->role == 1) ? 'disabled' : '' }}" 
                                            style="{{ (auth()->user()->role == 1) ? 'cursor: not-allowed !important; pointer-events: auto;' : '' }}" 
                                            data-bs-toggle="modal" data-bs-target="{{ (auth()->user()->role == 1) ? '' : '#modal' }}">
                                        <i class="fas fa-fw fa-star text-warning"></i>
                                        Beri Nliai Rating
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Beri Penilaian Hotel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('review.hotel') }}" method="POST" class="d-inline">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{ $detail->id }}" name="hotel_id" />
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control border-0" id="email" value="{{ auth()->user()->email }}" />
                            </div>
                        </div>

                        @if (!$review->isEmpty())
                            @foreach ($review as $item)
                                <div class="mb-3 row">
                                    <label for="nilai" class="col-md-2 col-form-label">Nilai : </label>
                                    <div class="col-md-10">
                                        <div class="rate">
                                            <input type="radio" id="star5" class="rate" name="nilai_rating" value="5"
                                                {{ ($item->nilai_rating == 5) ? 'checked' : null }} />
                                            <label for="star5">5 stars</label>
                                            <input type="radio" id="star4" class="rate" name="nilai_rating" value="4" 
                                                {{ ($item->nilai_rating == 4) ? 'checked' : null }} />
                                            <label for="star4">4 stars</label>
                                            <input type="radio" id="star3" class="rate" name="nilai_rating" value="3" 
                                                {{ ($item->nilai_rating == 3) ? 'checked' : null }} />
                                            <label for="star3">3 stars</label>
                                            <input type="radio" id="star2" class="rate" name="nilai_rating" value="2" 
                                                {{ ($item->nilai_rating == 2) ? 'checked' : null }} />
                                            <label for="star2">2 stars</label>
                                            <input type="radio" id="star1" class="rate" name="nilai_rating" value="1" 
                                                {{ ($item->nilai_rating == 1) ? 'checked' : null }} />
                                            <label for="star1">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="komentar" rows="6" maxlength="200" required
                                        placeholder="Tambahkan Komentar">{{ old('komentar', $item->komentar) }}</textarea>
                                </div>
                            @endforeach
                        @else
                            <div class="mb-3 row">
                                <label for="email" class="col-md-2 col-form-label">Nilai : </label>
                                <div class="col-md-10">
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="nilai_rating" value="5" />
                                        <label for="star5">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="nilai_rating" value="4" />
                                        <label for="star4">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="nilai_rating" value="3" />
                                        <label for="star3">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="nilai_rating" value="2" />
                                        <label for="star2">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="nilai_rating" value="1" />
                                        <label for="star1">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="komentar" rows="6" maxlength="200" required
                                    placeholder="Tambahkan Komentar">{{ old('komentar') }}</textarea>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let btnRating = document.querySelector('btn-rating');
        btnRating.addEventListener('mouseOver')
    </script>
@endsection
