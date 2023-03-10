@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.hotel'])

@section('breadcumb')
<div class="pagetitle">
    <h1>Hotel</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Master Data</li>
            <li class="breadcrumb-item active">Hotel</li>
        </ol>
    </nav>
</div>
@endsection

@section('content-dashboard')
    @if (session()->has('success'))
        <div class="alert alert-success col-md-6 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-header mt-3">
            <div class="row justify-content-between mb-3">
                <div class="col-md-9">
                    <h2 class="h2 text-black-50">Data Hotel</h2>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('data_hotel.create') }}" class="btn btn-success btn-sm float-end">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Hotel
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="data-table-container">
                <table class="table table-bordered table-striped datatable" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gradient-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Golongan Tiket</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $nomor = 1; @endphp
                        @foreach ($dataHotel as $item)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>{{ $item->kode_hotel }}</td>
                            <td>{{ $item->nama_hotel }}</td>
                            <td>
                                @if ($item->image_hotel)
                                <img src="{{ asset('storage/' . $item->image_hotel)}}" class="img-fluid" width="100"
                                    alt="gambar">
                                @else
                                <img src="{{ asset('assets/img/blank-hotel.webp') }}" alt="blank-hotel" class="img-fluid"
                                    width="100">
                                @endif
                            </td>
                            <td>{{ $item->tiket->nama_tiket }}</td>
                            <td>@harga($item->harga_hotel)</td>
                            <td>
                                <a href="{{ route('data_hotel.show', $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-info-lg"></i></a>
                                <a href="{{ route('data_hotel.edit', $item->id) }}" class="btn btn-secondary btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('data_hotel.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm sweet-delete">
                                        <i class="bi bi-trash"></i>
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

@section('script')
<script>
    $('.sweet-delete').click(function(event){
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Hotel?',
                text: "Anda Yakin Ingin Menghapusnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                setTimeout(() => {
                    if(result.isConfirmed) {
                        form.submit();
                    }
                }, 500);
            });
        });
</script>
@endsection