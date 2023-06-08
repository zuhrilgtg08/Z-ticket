@extends('layouts.frontend.mainFrontend')
@section('content')
    <section class="bg-default" style="background-color: #fff">
        <div class="container py-3">
            <div class="row justify-content-center py-5">
                <h3 class="text-center my-2">Your History Order</h3>

                <div class="col-md-10 my-5 mt-5">
                    <div class="card mt-5">
                        <div class="card-body shadow border-0">
                            @if (!$listHistory->isEmpty())
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center bg-success text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tiket</th>
                                            <th>Nama Hotel</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php $no = 1; @endphp

                                        @foreach ($listHistory as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->tiket->nama_tiket }}</td>
                                                <td>{{ $item->hotel->nama_hotel }}</td>
                                                <td>{{ $item->quantity }} Item</td>
                                                <td>@harga($item->tiket->harga)</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary d-inline btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <i class="bi bi-info-circle"></i> Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="card-title text-center my-5 rounded border-0">
                                    <h2 class="text-danger m-auto">History is Empty</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row my-1">
                        <h6 class="col-sm-3 text-danger">Name : </h6>
                        <p class="col-sm-9 h6">{{ $name }}</p>
                        <h6 class="col-sm-3 text-danger">Email : </h6>
                        <p class="col-sm-9 h6">{{ $email }}</p>
                        <h6 class="col-sm-3 text-danger">Phone : </h6>
                        <p class="col-sm-9 h6">{{ $phone }}</p>
                        <div class="col-md-10 mt-3">
                            <ul class="list-group mb-3">
                                @foreach ($listHistory as $q)
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <small class="text-danger d-block my-1">ID Pesanan : {{ substr($q->pesanan->uuid, 0, -20); }}</small>
                                            <h6 class="my-0">{{ $q->tiket->nama_tiket }}</h6>
                                            <small class="text-dark d-block my-1">Kamar yang Dipesan : {{ $q->hotel->nama_hotel }}</small>
                                            <small class="text-success fw-bold my-1">Harga : @harga($q->tiket->harga)</small>
                                        </div>
                                        <span class="text-danger">{{ $q->quantity }} Tiket</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <h6 class="col-sm-3 text-success">Total : </h6>
                        <p class="col-sm-9 h6">@harga($total)</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('history.print', auth()->user()->id) }}" class="btn btn-success">Print</a>
                </div>
            </div>
        </div>
    </div>
@endsection