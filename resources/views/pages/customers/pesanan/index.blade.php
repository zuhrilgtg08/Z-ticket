@extends('layouts.frontend.mainFrontend')

@section('content')
   <section class="bg-default">
        <div class="container py-3">
            <div class="row justify-content-center my-5">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            
                @if(session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
                        {{ session('danger') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-lg-7 mt-3">
                    <div class="card shadow border-0 my-5">
                        <div class="card-body">
                            <h4 class="card-title">Pesanan Anda</h4>
                            <div class="row g-3">
                                <div class="col-md-5 mb-3">
                                    <p>Nama : <span>{{ auth()->user()->username }}</span></p>
                                    <p>Email : <span>{{ auth()->user()->email }}</span></p>
                                    <p>Phone : <span>{{ auth()->user()->phone }}</span></p>
                                    <h6>
                                        <span>Total Harga (Rp) : </span>
                                        <strong class="text-primary">@harga($totalHarga)</strong>
                                    </h6>
                                </div>
                                <div class="col-md-7 mb-3">
                                    <ul class="list-group mb-3">
                                        @foreach ($dataPesanan as $item)
                                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                                <div>
                                                    <h6 class="my-0">{{ $item->tiket->nama_tiket }}</h6>
                                                    <small class="text-dark d-block my-1">Kamar yang Dipesan : {{ $item->hotel->nama_hotel }}</small>
                                                    <small class="text-danger d-block my-1">Kode Tiket : {{ $item->tiket->kode_tiket }}</small>
                                                    <small class="text-success fw-bold my-1">Harga : @harga($item->tiket->harga)</small>
                                                </div>
                                                <span class="text-danger">{{ $item->quantity }} Tiket</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-warning" type="button" id="pay-button">
                                    <i class="fas fa-fw fa-wallet"></i>
                                    Bayar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>
@endsection