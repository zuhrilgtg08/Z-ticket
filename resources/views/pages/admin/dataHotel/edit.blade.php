@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.hotel'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Hotel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item"><a href="/data_hotel">Hotel</a></li>
                <li class="breadcrumb-item active">Edit</li>
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
                        <h2 class="h2 text-black-50">Edit Hotel</h2>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-secondary btn-sm mb-4 float-end" href="{{ route('data_hotel.index') }}">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('data_hotel.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_hotel" class="form-label">Nama Hotel : </label>
                                <input class="form-control @error('nama_hotel') is-invalid @enderror" name="nama_hotel"
                                    type="text" id="nama_hotel" value="{{ old('nama_hotel', $hotel->nama_hotel) }}" required />
                                @error('nama_hotel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="harga_hotel" class="form-label">Biaya Kamar : </label>
                                <input class="form-control @error('harga_hotel') is-invalid @enderror"
                                    name="harga_hotel" type="number" id="harga_hotel" value="{{ old('harga_hotel', $hotel->harga_hotel) }}"
                                    min="1" required />
                                @error('harga_hotel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image_hotel" class="form-label">Gambar Hotel : </label>
                                <!-- hidden image -->
                                <input type="hidden" name="gambarLama" value="{{ $hotel->image_hotel }}">
                                @if ($hotel->image_hotel)
                                    <img src="{{ asset('storage/'. $hotel->image_hotel) }}" alt="gambar" class="img-fluid mb-3 sm-2 d-block image-preview">
                                @else 
                                    <img class="image-preview img-fluid mb-3 sm-2">
                                @endif
                                <input class="form-control-file @error('image_hotel') is-invalid @enderror"
                                    name="image_hotel" type="file" id="image_hotel" value="{{ old('image_hotel') }}"
                                    onchange="imagePreview()" />
                                @error('image_hotel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug Hotel : </label>
                                <input class="form-control @error('slug') is-invalid @enderror" name="slug" type="text"
                                    id="slug" value="{{ old('slug', $hotel->slug) }}"/>
                                @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tiket_id" class="form-label">Golongan Tiket : </label>
                                <select name="tiket_id" id="tiket_id" class="form form-select @error('tiket_id') is-invalid @enderror data-tiket" required>
                                    <option value="" selected disabled>Pilih Tiket</option>
                                    @foreach ($tikets as $data)
                                    <option value="{{ $data->id }}" 
                                        @if($data->id == $hotel->tiket_id) selected @endif>{{ $data->nama_tiket }}</option>
                                    @endforeach
                                </select>
                                @error('tiket_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_hotel" class="form-label">Deskripsi : </label>
                        <input type="hidden" class="form-control @error('deskripsi_hotel') is-invalid @enderror"
                            id="deskripsi_hotel" name="deskripsi_hotel" required value="{{ old('deskripsi_hotel', $hotel->deskripsi_hotel) }}">
                        @error('deskripsi_hotel')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <trix-editor input="deskripsi_hotel"></trix-editor>
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
        $('.data-tiket').select2();
    });

    const nama_hotel = document.querySelector('#nama_hotel');
    const slug = document.querySelector('#slug');
    nama_hotel.addEventListener('change', function(){
        fetch('/dashboard/hotel/slug?title=' + nama_hotel.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    function imagePreview() {
            const imageInput = document.querySelector('#image_hotel');
            const imagePreview = document.querySelector('.image-preview');
            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imageInput.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
</script>
@endsection