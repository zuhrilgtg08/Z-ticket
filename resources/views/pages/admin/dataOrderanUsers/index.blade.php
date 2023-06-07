@extends('layouts.dashboard.mainDashboard', ['isActive' => 'menu.orders'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Data Orders Customers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/data_orders">Data Orders Customers</a></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="card mb-3">
        <div class="card-header mt-3">
            <div class="row justify-content-between mb-3">
                <div class="col-md-9">
                    <h2 class="h2 text-black-50">Data Orders Customers</h2>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('export.orders') }}" class="btn btn-danger btn-sm float-end">
                        <i class="bi bi-filetype-pdf"></i>
                        Export Data
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="data-table-container">
                <table class="table table-bordered table-striped datatable text-center" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-gradient-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Nama Tiket</th>
                            <th>Jumlah</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-900 text-base">
                        @php $nomor = 1; @endphp

                        @foreach ($listOrder as $item)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ substr($item->pesanan->uuid, 0, -28); }}</td>
                                <td>{{ $item->tiket->nama_tiket }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    @if ($item->pesanan->payment_status == 2)
                                        <span class="badge bg-success">Success Paid</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Unpaid</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('data_orders.show', $item->pesanan->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection