<!-- resources/views/kategori/show_buku.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Buku - Kategori: {{ $kategori->nama }}</h1>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $buku)
                    <tr>
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
