@extends('layouts.frontend.mainFrontend')
@section('content')
    <section class="bg-default">
        <div class="container py-3">
            <div class="row justify-content-center my-5">
                <div class="col-lg-12 mb-4">
                    <div class="card border-0 shadow rounded my-5">
                        <div class="card-header">
                            <div class="row justify-content-center text-center my-2">
                                <div class="col-md-4 m-auto">
                                    <a href="{{ url('/home') }}" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Lanjut Explore</a>
                                </div>
                                <div class="col-md-4 m-auto">
                                    <h3 class="text-gray-50 fst-italic">List Keranjang Saya</h3>
                                </div>
                                <div class="col-md-4 m-auto">
                                    <a href="{{ route('order.detail', auth()->user()->id) }}" class="btn btn-primary {{ ($keranjangs->count() == 0) ? 'd-none' : '' }}">
                                        Detail Keranjang <i class="bi bi-check-circle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (!$carts->isEmpty())
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
                                                            <select name="hotel_id" id="select-hotel" class="form-select slc-hotel">
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
                                                        <p class="font-bold m-auto" style="font-weight: 500 !important;">
                                                            <span class="badge bg-warning text-dark">@harga($item->tiket->harga * $item->tiket->stok)</span>
                                                        </p>
                                                    @else
                                                        <p class="font-bold m-auto" style="font-weight: 500 !important;">
                                                            <span class="badge bg-warning text-dark">@harga($item->tiket->harga * $item->quantity)</span>
                                                        </p>
                                                    @endif
                                                </td>
                                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-inline" id="cart-form-delete">
                                                    @csrf
                                                    <td>
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="bi bi-trash2-fill"></i>
                                                            Delete
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="row justify-content-center my-4">
                                    <div class="col-md-8">
                                        <h4 class="m-auto text-center">
                                            <span class="badge bg-danger">Cart List Tidak Ada</span>
                                        </h4>
                                    </div>
                                </div>
                            @endif
                            <div class="row justify-content-end">
                                <div class="col-lg-12 m-auto">
                                    <h5 class="font-bold float-end">Total : <span>@harga($totalPayment)</span></h5>
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
            let selectHotel = document.getElementsByClassName('slc-hotel');
            Array.from(selectHotel).forEach((km) => {
                km.addEventListener('change', debounce(() => km.form.submit()))
            })
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