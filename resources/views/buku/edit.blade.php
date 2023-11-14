<div class="container">
<h4>Update Buku</h4>
    @if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
</ul>
@endif
<form enctype="multipart/form-data"action="{{route('buku.update', $data_buku->id)}}" method="POST">
    @csrf
    <div>Judul
        <br>
        <input type="text" name="nama" value="{{$data_buku->judul}}">
    </div>
    <br>
    <div>Penulis
        <br>
        <input type="text" name="penulis" value="{{$data_buku->penulis}}">
    </div>
    <br>
    <div>Harga
        <br>
        <input type="text" name="harga" value="{{$data_buku->harga}}">
    </div>
    <br>
    <div>Tgl. Terbit
        <br>
        <input type="date" name="tgl_terbit" value="{{$data_buku->tgl_terbit}}">
    </div>
    <br>
    <div>Image
        <br>
        <input type="file" name="thumbnail" id="thumbnail" alt="image">
    </div>
    <br>
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
   
    <div><button type="submit">Simpan</button></div>
    <a href="/buku"> Batal</a>
    <br>
    <div class="d-flex flex-wrap" id="gallery_item">
        @foreach($data_buku->galeri()->get() as $gallery)
            <div class="gallery_item">
                <img
                class="rounded-full object-cover object-center"
                src="{{ asset($gallery->path) }}"
                alt=""
                width="400"
                />
                <a href="{{ route('buku.delete-gallery', $gallery->id) }}" class="btn btn-danger" onclick="hapusData()">Delete</a>
            </div>
            @endforeach
        </div>
    <br>
    <div class="gallery_items">
                        @foreach($data_buku->galeri()->get() as $gallery)
                            <div class="gallery_item">
                                <img
                                class="rounded-full object-cover object-center"
                                src="{{ asset($gallery->path) }}"
                                alt=""
                                width="400"
                                />
                            </div>
                        @endforeach
                    </div>


</form>
</div>