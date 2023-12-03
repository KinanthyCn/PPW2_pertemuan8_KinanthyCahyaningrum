<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Favorite Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div class="container" style="margin-top: 5%">
                        @if(Session::has('pesan'))
                        <div class="alert alert-success fade show" id="success-alert" role="alert">{{ Session::get('pesan') }}</div>
                        @endif

                        @if(count($errors) > 0)
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li style="list-style: none;">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="card">
                            <div class="card-body">

                                <table class="table table-striped table-bordered table-fixed">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Thumbnail</th>
                                            <th scope="col">Judul Buku</th>
                                            <th scope="col">Penulis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($favoriteBooks as $data_favorite)
                                        <tr>
                                            <td>{{ $data_favorite->buku->id }}</td>
                                            <td>
                                                <a href="{{ route('buku.showFavorite', $data_favorite->buku->id) }}">
                                                    <div class="flex items-center">
                                                        @if ($data_favorite->buku->filepath)
                                                        <div class="relative h-10 w-10">
                                                            <img class="h-full w-full rounded-full object-cover object-center"
                                                                src="{{ asset($data_favorite->buku->filepath) }}" alt="thumbnail" />
                                                        </div>
                                                        @endif
                                                    </div>
                                                </a>
                                            <td>{{ $data_favorite->buku->judul }}
                                            </td>
                                            <td>{{ $data_favorite->buku->penulis }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

