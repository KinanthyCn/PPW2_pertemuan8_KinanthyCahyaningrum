@extends('layouts.layout')

@section('title', 'Add Book')

@section('content')
   <div class="container">
    <h4> Tambah Buku</h4>
    @if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
    <form method="POST" action="{{route('buku.store')}}"
    >@csrf
        <div>Judul <br>
        <input type="text" name="judul"></div>
        <div>Penulis <br>
        <input type="text" name="penulis"></div>
        <div>Harga <br>
        <input type="text" name="harga"></div>
        <div>Tgl. Terbit <br>
        <input type="date" name="tgl_terbit"></div>
        <br>
        <div>
            <button type="submit">Simpan</button>
            <a href="/buku" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>
@endsection