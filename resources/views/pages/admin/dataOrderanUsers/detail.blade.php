@extends('layouts.dashboard.mainDashboard', ['isActive' => 'menu.orders'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Detail Orders Customers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/data_orders">Data Orders Customers</a></li>
                <li class="breadcrumb-item active">Detail Orders Customers</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="card mb-3">
        <div class="card-header mt-3">
            <h2 class="h2 mb-3 text-black-50">Detail Orders Customers</h2>
        </div>
        <div class="card-body">
            <div class="card-title">
                <dl class="row">
                    <h5 class="col-sm-3 text-success">ID Pesanan : </h5>
                    <p class="col-sm-9">{{ $data->pesanan->uuid }}</p>
                    <h5 class="col-sm-3 text-success">Nama Pemesan : </h5>
                    <p class="col-sm-9">{{ $data->user->username }}</p>
                    <h5 class="col-sm-3 text-success">Email : </h5>
                    <p class="col-sm-9">{{ $data->user->email }}</p>
                    <h5 class="col-sm-3 text-success">Phone : </h5>
                    <p class="col-sm-9">{{ $data->user->phone }}</p>
                </dl>
            </div>
            <table class="table table-bordered">
                <thead class="bg-danger text-white text-center">
                    <tr>
                        <th>Nama Tiket</th>
                        <th>Nama Hotel</th>
                        <th>Jumlah</th>
                        <th>Payment Status</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $item->tiket->nama_tiket }}</td>
                            <td>{{ $item->hotel->nama_hotel }}</td>
                            <td>{{ $item->quantity }} Item</td>
                            <td><span class="badge bg-success">{{ $item->status_pembayaran }}</span></td>
                            <td>@harga($item->tiket->harga)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-sm-11 text-end my-2">
                <p class="h4">Total Harga : @harga($sumHarga)</p>
            </div>
        </div>
    </div>
@endsection