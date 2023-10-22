<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
<div class="flash-message">
    @if (session()->has('pesan'))
        <div class="alert alert-success">
            {{ session('pesan') }}
        </div>
    @endif
</div>
<form action="{{ route('buku.search') }}" method="get">
    @csrf
    <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%;
    display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
</form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th> id</th>
                <th> Judul Buku</th>
                <th> Penulis</th>
                <th> Harga</th>
                <th> Tgl.terbit</th>
                <th> Aksi</th>
                <th> Hapus </th>
            </tr>
</thead>
<tbody>
    @foreach($data_buku as $buku)
    <tr>
        <td>{{ $buku->id}}</td>
        <td>{{ $buku->judul}}</td>
        <td>{{ $buku->penulis}}</td>
        <td>{{ "Rp ".number_format($buku->harga, 0, ', ', '.')}}</td>
        <td>{{ date('d-m-Y', strtotime($buku->tgl_terbit)) }}</td>
        <td>
    <p>
        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary" >Edit</a>
    </p>
</td>
        <td>  
            <p>
                 <form action="{{ route('buku.destroy', $buku->id) }}" method="post">@csrf <button
            onclick="return confirm('yakin mau dihapus?')">Hapus</button></form>
            </p>
    </td>
    </tr>
@endforeach
</tbody>
</table>
<div>{{ $data_buku->links() }}</div>

<p>Jumlah Data: {{ $jumlahData }}</p>
<p>Total Harga Buku: {{ "Rp ".number_format($totalHarga, 2, ', ','.') }}</p>
<p>
    <a href="{{ route('buku.create')}}">Tambah Buku</a>
</p>

</body>
</html>