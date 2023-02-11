@extends('layouts.frontend.mainFrontend')
@section('style')
    <style>
        .categories:hover {
            transform: scale(1.1);
            transition: all ease .5s;
        }
    </style>
@endsection
@section('content')
    <section class="bg-secondary">
        <div class="container">
            <div class="row justify-content-center py-5">
                @foreach ($categories as $key => $category)
                    <div class="col-md-4 mt-5">
                        <a href="/home?category={{ $category->slug }}">
                            <div class="card text-white rounded shadow-sm categories">
                                <img src="{{ asset('assets/img/category-ticket.jpg') }}" alt="Category" class="img-fluid card-img">
                                <div class="card-img-overlay d-flex align-items-center p-0">
                                    <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgb(18, 201, 33);">
                                        {{ $category->nama_kategori }}
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection