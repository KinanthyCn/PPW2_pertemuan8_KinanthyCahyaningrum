<!-- resources/views/kategori/form.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($kategori) ? 'Edit' : 'Tambah' }} Kategori</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store') }}" method="POST">
            @csrf
            @if (isset($kategori))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($kategori) ? $kategori->nama : old('nama') }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($kategori) ? 'Update' : 'Tambah' }}</button>
        </form>
    </div>
@endsection
