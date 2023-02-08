@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.kategori'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item active">Kategori</li>
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
                    <h2 class="h2 text-black-50">Data Kategori</h2>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('data_categories.create') }}" class="btn btn-success float-end btn-sm">
                        <i class="bi bi-plus-lg"></i>
                        Buat Kategori
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
                            <th>Nama</th>
                            <th>Slug Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $nomor = 1; @endphp
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>
                                    <a href="{{ route('data_categories.edit', $item->id) }}" class="btn btn-secondary">
                                        <i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('data_categories.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger sweet-delete">
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