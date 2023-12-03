<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Favorit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
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
                            <th scope="col" style="width: 50px;">No.</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Penulis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($favoriteBooks as $buku)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                <a href="{{ route('buku.showFavorite', $buku->id) }}">
                                    <div class="flex items-center">
                                        @if ($buku->filepath)
                                        <div class="relative h-10 w-10">
                                            <img class="h-full w-full rounded-full object-cover object-center"
                                                src="{{ asset($buku->filepath) }}" alt="thumbnail" />
                                        </div>
                                        @endif
                                        <span class="ml-2">{{ $buku->judul }}</span>
                                    </div>
                                </a>
                            </td>
                            <td>{{ $buku->penulis }}</td>
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
</body>

</html>
