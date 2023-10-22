<div class="container">
<h4>Update Buku</h4>
    @if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{route('buku.update', $data_buku->id)}}" method="POST">
    @csrf
    <div>Judul
        <input type="text" name="nama" value="{{$data_buku->judul}}">
    </div>
    <div>Penulis
        <input type="text" name="penulis" value="{{$data_buku->penulis}}">
    </div>
    <div>Harga
        <input type="text" name="harga" value="{{$data_buku->harga}}">
    </div>
    <div>Tgl. Terbit
        <input type="date" name="tgl_terbit" value="{{$data_buku->tgl_terbit}}">
    </div>
    <div><button type="submit">Simpan</button></div>
    <a href="/buku"> Batal</a>
</form>
</div>