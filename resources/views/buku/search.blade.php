@include('layouts.layout')
<p align="right"><a href="{{ route('buku.create') }}">Tambah Buku</a></p>
@if(Session::has('pesan'))
    <div class="alert alert-success">{{ Session::get('pesan') }}</div>
@endif
<h1 align="center">DATA BUKU</h1>
<form action="{{ route('buku.search') }}" method="get">
    @csrf
    <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%;
    display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
</form>
@if(count($data_buku))
    <div class="alert alert-success">Ditemukan <strong>{{count($data_buku)}}</strong> data dengan kata: <strong>{{ $cari }}</strong></div>
@else
    <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan</h4><a href="/buku" class="btn btn-warning">Kembali</a></div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_buku as $buku)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ $buku->tgl_terbit }}</td>
                <td>
                <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                    @csrf 
                    <button onclick="return confirm('yakin mau dihapus?')">Hapus</button>
                </form>
                </td>
                <td>
                    <a href="{{ route('buku.edit', $buku->id) }}">Edit Buku</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">{{ $data_buku->links() }}</div>
<a href="/buku">Kembali</a>
<p>Total Buku : {{ $totalbuku }}</p>
<p>Total Harga : {{ "Rp ".number_format($total, 2, ',', '.') }}</p>