@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.reviews'])
@section('content-dashboard')
    <h2 class="h2 mb-3 text-black-50">Data Reviews Tiket</h2>

    @if (session()->has('error'))
        <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="card mb-3">
        <div class="card-body">
            <div class="data-table-container">
                <table class="table table-bordered table-striped text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gradient-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Tiket</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Total Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-900 text-base">
                        @php $nomor = 1; @endphp
                        @foreach ($tikets as $item)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $item->nama_tiket }}</td>
                                <td>
                                    <div class="text-center mx-auto">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="sampul" class="img-fluid"
                                                width="85" />
                                        @else
                                            <img src="{{ asset('assets/img/blank-tiket.webp') }}" alt="sampul" class="img-fluid"
                                                width="85" />
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $item->excerpt }}</td>
                                <td>{{ $item->nilai_rating }} <i class="fas fa-fw fa-thumbs-up text-success"></i></td>
                                <td>
                                    <a href="{{ route('data_reviews.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-fw fa-info"></i></a>
                                    <form action="{{ route('data_reviews.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Ingin menghapus Komentar ini ?')">
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