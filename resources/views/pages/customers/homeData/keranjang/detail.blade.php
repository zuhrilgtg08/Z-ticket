@extends('layouts.frontend.mainFrontend')

@section('content')
    <section class="bg-default">
        <div class="container py-3">
            <div class="row justify-content-center my-5">
                @if (session()->has('success'))
                    <div class="alert alert-success col-md-6 alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session()->has('danger'))
                    <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert" id="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('danger') }}
                    </div>
                @endif

                <div class="col-md-7 col-lg-8 order-md-last">
                    <h4 class="mb-3 text-center">Input Data Pesanan Anda</h4>
                    
                    <form class="d-inline" action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_pembayaran" value="{{ $totalHarga }}" id="total_pembayaran" />
                        <input type="hidden" name="payment_status" value="1" id="payment_status" />
                
                        <div class="row my-4">
                            <div class="col-lg-6">
                                <div class="card shadow border-1 h-100">
                                    <div class="card-body border-1">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Pemesan : </label>
                                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->username }}" />
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Nomor Hp :</label>
                                            <input type="text" class="form-control" id="phone" value="{{ Auth::user()->phone ?? '-' }}" />
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email :</label>
                                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-danger">Pesanan Anda</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    @foreach ($cart_datas as $item) 
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">{{ $item->tiket->nama_tiket }}</h6>
                                                <small class="text-danger d-block">Kode Tiket : {{ $item->tiket->kode_tiket }}</small>
                                                <small class="text-success fw-bold">Harga : @harga($item->tiket->harga)</small>
                                            </div>
                                            <span class="text-danger">{{ $item->quantity }} Tiket</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body">
                                        <h5 class="d-flex justify-content-between align-items-center">
                                            <span>Total Harga (Rp) : </span>
                                            <strong class="text-success">@harga($totalHarga)</strong>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-end">
                            <button class="btn btn-success" type="submit">
                                <i class="fas fa-fw fa-check"></i>
                                Buat Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection