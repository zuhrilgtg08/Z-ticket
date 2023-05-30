@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.account'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Account Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item active">Account Users</li>
            </ol>
        </nav>
    </div>
@endsection



@section('content-dashboard')
    @if (session()->has('error'))
        <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-header mb-3">
            <h2 class="text-black-50">Account Users</h2>
        </div>
        <div class="card-body">
            <div class="data-table-container">
                <table class="table table-bordered table-striped text-center datatable" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gradient-light">
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Profil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-900 text-base">
                        @php $nomor = 1; @endphp
                        @foreach ($pengguna as $item)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <div class="text-center mx-auto">
                                        @if ($item->profile)
                                            <img src="{{ asset('storage/' . $item->profile) }}" alt="profile" class="img-fluid" width="100" />
                                        @else
                                            <img src="{{ asset('assets/img/users.png') }}" alt="profile" class="img-fluid" width="100"/>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('data_account.show', $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-info-lg"></i></a>
                                    <form action="{{ route('data_account.destroy', $item->id) }}" method="POST" class="d-inline">
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
                title: 'Hapus Account?',
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