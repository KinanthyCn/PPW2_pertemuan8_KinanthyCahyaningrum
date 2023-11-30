<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/lightbox.min.css') }}">
    <style>
        /* Tambahkan gaya tambahan di sini jika diperlukan */
        body {
            padding-top: 20px;
        }

        #album {
            background-color: #f8f9fa;
            padding: 40px 0;
        }

        h2 {
            color: #007bff;
        }

        .thumbnail img {
            width: 100%;
            height: auto;
        }

        .book-info {
            margin-top: 20px;
        }

        .book-info p {
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="flash-message">
    @if (session()->has('pesan'))
        <div class="alert alert-success">
            {{ session('pesan') }}
        </div>
    @endif
</div>
    
    <div class="container">
        <section id="album" class="py-5 text-center">
            <div class="container">
                <h2 class="mb-4">{{ $data_buku->judul }}</h2>
                <hr>
                <div class="row">
                <!-- <a href="{{ asset($data_buku->path) }}" data-lightbox="image-1">
    <img src="{{ asset($data_buku->filepath) }}" alt="{{ $data_buku->filename }}" class="img-fluid">
</a> -->
                    @foreach ($data_buku->galeri()->get() as $data)
                        <div class="col-md-4 mb-4">
                            <div class="thumbnail">
                                <a href="{{ asset($data->path) }}" data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                                    <img src="{{ asset($data->path) }}" alt="{{ $data->keterangan }}" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="book-info text-left">
                <h4>Informasi Buku:</h4>
                <p><strong>Penulis:</strong> {{ $data_buku->penulis }}</p>
                <p><strong>Harga:</strong> {{ $data_buku->harga }}</p>
                <p><strong>Tanggal Terbit:</strong> {{ $data_buku->tgl_terbit }}</p>
                <form id="ratingForm" action="{{ route('buku.rating', $data_buku->id) }}" method="POST">
                    @csrf
                    <label for="rating">Rating: </label>
                    <select id="rating" name="rating" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit">Submit Rating</button>
                </form>
                <p><strong>Rating:</strong>
                                @if($data_buku->ratings->isNotEmpty())
                                    {{ number_format($data_buku->ratings->avg('rating'), 1) }}
                                @else
                                    No rating available
                                @endif
                            </p>
                <span class="ml-2">{{ $data_buku->judul }}</span>
@if(Auth::check() && Auth::user()->favorites && Auth::user()->favorites->contains($data_buku))
    <!-- Buku sudah ada di favorit -->
    <span class="ml-auto mr-2">
        <i class="fas fa-heart text-danger text-right"></i>
    </span>
@else
    <!-- Tambahkan ke favorit -->
    <form action="{{ route('buku.favorit', $data_buku->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-link">
            <i class="far fa-heart text-danger"></i> Tambahkan ke Favorit
        </button>
    </form>
@endif

            </div>
        </section>
    </div>
    

    <script src="{{ asset('dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

