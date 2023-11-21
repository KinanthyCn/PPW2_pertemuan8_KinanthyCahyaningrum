<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>List Buku</h1>

        <div class="flash-message">
            @if (session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session('pesan') }}
                </div>
            @endif
        </div>

        <form action="{{ route('buku.search') }}" method="get" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%;" />
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <td>
                            @if ($buku->filepath)
                                <div class="relative h-13 w-13">
                                    <img class="img-fluid" src="{{ asset($buku->filepath) }}" alt="">
                                </div>
                            @endif
                        </td>
                        <td>{{ $buku->judul }}</td>
                        <td><a href="{{ route('buku.galeri.buku', $buku->id) }}" class="btn btn-primary">See Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
