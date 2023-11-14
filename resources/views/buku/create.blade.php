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
    <form method="POST" action="{{route('buku.store')}}" enctype="multipart/form-data">
        @csrf
        <div>Judul <br>
        <input type="text" name="judul"></div>
        <div>Penulis <br>
        <input type="text" name="penulis"></div>
        <div>Harga <br>
        <input type="text" name="harga"></div>
        <div>Tgl. Terbit <br>
        <input type="date" name="tgl_terbit"></div>
        <br>
        <div>Thumbnail
            <br>
        <input type="file" name="thumbnail" id="thumbnail" alt="image">
    </div>
    <br>
    <div class="col-span-full mt-6">
                        <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                        <div class="mt-2" id="fileinput_wrapper">

                        </div>
                        <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                        <script type="text/javascript">
                            function addFileInput () {
                                var div = document.getElementById('fileinput_wrapper');
                                div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                            };
                        </script>
                    </div>
    <br>
        <div>
            <button type="submit">Simpan</button>
            <a href="/buku" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>
@endsection