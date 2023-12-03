<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                                <h2 class="mb-4">Detail Buku</h2>
                                <hr>
                                <div class="row">
                                    @foreach ($data_buku as $buku)
                                        <div class="col-md-4 mb-4">
                                            <div class="thumbnail">
                                                <a href="{{ asset($buku->path) }}" data-lightbox="image-1" data-title="{{ $buku->keterangan }}">
                                                    <img src="{{ asset($buku->path) }}" alt="{{ $buku->keterangan }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="book-info text-left">
                                <h4>Informasi Buku:</h4>
                                <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                                <p><strong>Harga:</strong> {{ $buku->harga }}</p>
                                <p><strong>Tanggal Terbit:</strong> {{ $buku->tgl_terbit }}</p>
                                <hr class="my-4">

                                <form action="{{ route('buku.favorite', $buku->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-yellow-500">+ Favourite</button>
                                </form>

                                <br>

                                <form id="ratingForm" action="{{ route('buku.rating', $buku->id) }}" method="POST">
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
                                    @if($buku->ratings->isNotEmpty())
                                        {{ number_format($buku->ratings->avg('rating'), 1) }}
                                    @else
                                        No rating available
                                    @endif
                                </p>
                            </div>
                        </section>
                    </div>

                    <script src="{{ asset('dist/js/lightbox-plus-jquery.min.js') }}"></script>
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



