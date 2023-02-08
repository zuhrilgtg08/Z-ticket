@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.tiket'])
@section('content-dashboard')
    <h2 class="h2 mb-3 text-black-50">Data Tiket</h2>
    
    @if (session()->has('success'))
        <div class="alert alert-success col-md-6 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="card mb-3">
        <div class="card-header py-2">
            <a href="{{ route('data_tiket.create') }}" class="btn btn-success btn-sm float-right">
                <i class="fas fa-fw fa-plus"></i>
                Buat Tiket
            </a>
        </div>
        <div class="card-body">
            <div class="data-table-container">
                <table class="table table-bordered table-striped text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gradient-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $nomor = 1; @endphp
                        @foreach ($tikets as $item)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $item->kode_tiket }}</td>
                                <td>{{ $item->nama_tiket }}</td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image )}}" class="img-fluid" width="100" alt="sampul">
                                    @else
                                        <img src="{{ asset('assets/img/blank-tiket.webp') }}" alt="blank-tiket" class="img-fluid" width="100">
                                    @endif
                                </td>
                                <td>{{ $item->stok }} Tiket</td>
                                <td>@harga($item->harga)</td>
                                <td>
                                    <a href="{{ route('data_tiket.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('data_tiket.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-fw fa-pencil-alt"></i></a>
                                    <form action="{{ route('data_tiket.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Ingin menghapus tiket ini ?')">
                                            <i class="fas fa-fw fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection