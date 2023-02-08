@extends('layouts.dashboard.mainDashboard', ['isMaster' => true, 'isActive' => 'menu.kategori'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item"><a href="/data_categories">Kategori</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
<div class="row justify-content-center py-4">
    <div class="col-lg-6">
        <div class="card shadow-inner border-0 h-100">
            <div class="card-header mt-3">
                <div class="row justify-content-between mb-3">
                    <div class="col-md-8">
                        <h2 class="text-black-50">Edit Kategori</h2>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-secondary float-end btn-sm" href="{{ route('data_categories.index') }}">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('data_categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori : </label>
                        <input class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" type="text"
                            id="nama_kategori" value="{{ old('nama_kategori', $category->nama_kategori) }}" required />
                        @error('nama_kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug Kategori : </label>
                        <input class="form-control @error('slug') is-invalid @enderror" name="slug" type="text" id="slug"
                            value="{{ old('slug', $category->slug) }}" readonly />
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
        const title = document.querySelector('#nama_kategori');
        const slug = document.querySelector('#slug');
        title.addEventListener('change', function(){
            fetch('/dashboard/categories/slug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>
@endsection