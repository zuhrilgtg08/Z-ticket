@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.tiket'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Tiket</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item"><a href="/data_tiket">Tiket</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="row justify-content-center py-4">
        <div class="col-lg-10">
            <div class="card shadow-inner border-0">
                <div class="card-header mt-3">
                    <div class="row justify-content-between">
                        <div class="col-md-8">
                            <h2 class="h2 text-black-50">Create Tiket</h2>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-secondary btn-sm mb-4 float-end" href="{{ route('data_tiket.index') }}">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('data_tiket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_tiket" class="form-label">Nama Tiket : </label>
                                    <input class="form-control @error('nama_tiket') is-invalid @enderror" name="nama_tiket" type="text"
                                        id="nama_tiket" value="{{ old('nama_tiket') }}" required />
                                    @error('nama_tiket')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stok_tiket" class="form-label">Stok Tiket : </label>
                                    <input class="form-control @error('stok') is-invalid @enderror" name="stok" type="number" id="stok_tiket"
                                        value="{{ old('stok') }}" min="1" required />
                                    @error('stok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga_tiket" class="form-label">Harga Tiket : </label>
                                    <input class="form-control @error('harga') is-invalid @enderror input-harga" name="harga" type="number" id="harga_tiket"
                                        value="{{ old('harga') }}" min="1" required />
                                    @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sampul_tiket" class="form-label">Sampul Tiket : </label>
                                    <img class="sampul-preview img-fluid mb-3 sm-2">
                                    <input class="form-control-file @error('image') is-invalid @enderror" name="image" type="file" id="sampul_tiket"
                                        value="{{ old('image') }}" onchange="sampulTiket()"/>
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi Asal : </label>
                                    <select name="provinsi_id" id="provinsi" class="form form-select @error('provinsi_id') is-invalid @enderror data-provinsi" required>
                                        <option value="" selected disabled>Data Provinsi</option>
                                        @foreach ($dataProKo as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota Asal : </label>
                                    <select name="kota_id" id="kota" class="form form-select @error('kota_id') is-invalid @enderror data-kota" required>
                                        <option value="">Data Kota/Kabupaten</option>
                                    </select>
                                    @error('kota_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori Tiket : </label>
                                    <select name="category_id" id="kategori" class="form form-select @error('category_id') is-invalid @enderror data-category" required>
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_tiket" class="form-label">Deskripsi : </label>
                            <input type="hidden" class="form-control @error('deskripsi_tiket') is-invalid @enderror" 
                                id="deskripsi_tiket" name="deskripsi_tiket" required value="{{ old('deskripsi_tiket') }}">
                            @error('deskripsi_tiket')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <trix-editor input="deskripsi_tiket"></trix-editor>
                        </div>
                        <div class="float-right mt-2">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.data-provinsi').select2();
            $('.data-kota').select2();
            $('.data-category').select2();
        });
        
        $(document).ready(function() {
            $('.data-provinsi').change(function(){
                let provinsiId = $(this).val();
                // console.log(provinsiId);
                if(provinsiId) {
                    $.ajax({
                        type: "get",
                        url: "/dashboard/tiket/provinsi/" + provinsiId,
                        dataType: "json",
                        success: function (response) {
                            // console.log(response.id);
                            $('.data-kota').empty();
                            $.each(response, function(key, value) {
                                $('.data-kota').append(
                                    '<option value="'+ value.id +'">' + value.nama_kota + '</option>'
                                );
                            });
                        }
                    });
                }
            })
        });

        function sampulTiket() {
                const sampulInput = document.querySelector('#sampul_tiket');
                const sampulPreview = document.querySelector('.sampul-preview');
                sampulPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(sampulInput.files[0]);

                oFReader.onload = function(oFREvent) {
                    sampulPreview.src = oFREvent.target.result;
                }
            }
    </script>
@endsection