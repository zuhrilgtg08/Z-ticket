@extends('layouts.dashboard.mainDashboard', ['isActive' => 'menu.reviews'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Reviews</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/data_reviews">Reviews</a></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    @if (session()->has('error'))
        <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="card mb-3">
        <div class="card-header mt-3">
            <h2 class="h2 text-black-50">Data Reviews Hotel</h2>
        </div>
        <div class="card-body">
            <div class="data-table-container">
                <table class="table table-bordered table-striped datatable text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gradient-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Hotel</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Nilai Rating</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-900 text-base">
                        @php $nomor = 1; @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $item->nama_hotel }}</td>
                                <td>
                                    <div class="text-center mx-auto">
                                        @if ($item->image_hotel)
                                            <img src="{{ asset('storage/' . $item->image_hotel) }}" alt="sampul" class="img-fluid"
                                                width="85" />
                                        @else
                                            <img src="{{ asset('assets/img/blank-hotel.webp') }}" alt="sampul" class="img-fluid"
                                                width="85" />
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $item->excerpt }}</td>
                                <td>{{ $item->nilai_rating }} <i class="bi bi-star-fill text-success"></i></td>
                                <td>
                                    <a href="{{ route('data_reviews.show', $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-info-circle-fill"></i></a>
                                    <form action="{{ route('data_reviews.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Ingin menghapus Komentar ini ?')">
                                            <i class="bi bi-trash-fill"></i>
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