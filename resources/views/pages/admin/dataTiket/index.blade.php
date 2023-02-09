@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.tiket'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Tiket</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item active">Tiket</li>
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
                    <h2 class="h2 text-black-50">Data Tiket</h2>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('data_tiket.create') }}" class="btn btn-success btn-sm float-end">
                        <i class="bi bi-plus-lg"></i>
                        Buat Tiket
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
                                    <a href="{{ route('data_tiket.show', $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-info-lg"></i></a>
                                    <a href="{{ route('data_tiket.edit', $item->id) }}" class="btn btn-secondary btn-sm"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('data_tiket.destroy', $item->id) }}" method="POST" class="d-inline">
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
                    title: 'Hapus Kategori?',
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