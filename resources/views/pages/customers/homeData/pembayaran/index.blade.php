@extends('layouts.frontend.mainFrontend')
@section('content')
    <section class="bg-default">
        <div class="container py-3">
            <div class="row justify-content-center my-5">
                <div class="col-lg-12 mb-4">
                    <div class="card border-0 shadow rounded">
                        <div class="card-header">
                            <div class="row justify-content-center text-center">
                                <div class="col-md-4 m-auto">
                                    <a href="{{ url('/home') }}" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Lanjut Explore</a>
                                </div>
                                <div class="col-md-4 m-auto">
                                    <h3 class="text-gray-50 fst-italic">List Keranjang Saya</h3>
                                </div>
                                <div class="col-md-4 m-auto">
                                    <a href="#" class="btn btn-primary {{ ($keranjangs->count() == 0) ? 'disabled' : '' }}">
                                        Konfimasi <i class="bi bi-check-circle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-7 mb-3">
                                @if(session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if(session()->has('danger'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('danger') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            <table class="table table-striped table-bordered border-1 border-secondary table-responsive">
                                <thead class="bg-success text-center text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tiket</th>
                                        <th>Jumlah</th>
                                        <th>Pilih Hotel</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @php $no = 1; @endphp
                                <tbody>
                                    @foreach ($carts as $item)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->tiket->nama_tiket }}</td>
                                            <form action="{{ route('cart.update', $item->id) }}" class="d-inline" method="POST" 
                                                id="cart-update">
                                                @csrf
                                                <td>
                                                    <div class="col-md-6 m-auto">
                                                        <input type="number" min="1" max="{{ $item->tiket->stok }}" 
                                                            value="{{ ($item->quantity >= $item->tiket->stok) ? $item->tiket->stok : $item->quantity }}" 
                                                                class="form-control text-center qty-input {{ ($item->quantity >= $item->tiket->stok) ? 'disabled' : '' }} 
                                                                    @error('quantity') is-invalid @enderror"
                                                                name="quantity" />
                                                        @error('quantity')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td class="col-sm-3 m-auto rounded">
                                                    @if ($item->tiket->hotel->isEmpty())
                                                        <p class="text-disabled" style="font-weight: 400 !important;">Tidak Ada 
                                                            <span class="font-bold fst-italic text-danger">Hotel</span> Yang Tersedia</p>
                                                    @else
                                                        <select name="hotel_id" id="select-hotel" class="form-select">
                                                            <option disabled selected>Pilih Hotel</option>
                                                            @foreach ($item->tiket->hotel as $km)
                                                                <option value="{{ $km->id }}" {{ ($item->hotel_id == $km->id) ? 'selected' : '' }}>
                                                                    {{old('hotel_id', $km->nama_hotel)}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </td>
                                            </form>
                                            <td>
                                                @if ($item->quantity >= $item->tiket->stok)
                                                    <p class="font-bold" style="font-weight: 500 !important;">
                                                        <span class="badge bg-warning text-dark">@harga($item->tiket->harga * $item->tiket->stok)</span>
                                                    </p>
                                                @else
                                                    <p class="font-bold text-success" style="font-weight: 500 !important;">
                                                        <span class="badge bg-warning text-dark">@harga($item->tiket->harga * $item->quantity)</span>
                                                    </p>
                                                @endif
                                            </td>
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-inline" id="cart-form-delete">
                                                @csrf
                                                <td>
                                                    <button class="btn btn-sm btn-danger cart-delete-btn" type="button">
                                                        <i class="bi bi-trash2-fill"></i>
                                                        Delete
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-8">
                                    @harga($totalPayment)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        let form = document.querySelector("#cart-update");
        let qty = document.getElementsByClassName("qty-input");

        $(document).ready(function () {
            $('.cart-delete-btn').click(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    setTimeout(() => {
                        if (result.isConfirmed) {
                            $('#cart-form-delete').submit();
                        }
                    }, 500);
                });
            });

            let selectHotel = document.querySelector('select[name="hotel_id"]');
            selectHotel.addEventListener('change', debounce(() => selectHotel.form.submit()))
        });

        Array.from(qty).forEach(function(q){
            q.addEventListener('change', debounce(() => q.form.submit()));
        });

        function debounce(func, timeout = 300) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {func.apply(this, args)}, timeout);
            }
        }
    </script>
@endsection