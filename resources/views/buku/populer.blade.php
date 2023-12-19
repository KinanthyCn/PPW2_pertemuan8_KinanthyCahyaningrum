<!DOCTYPE html>
<html>
<head>
    <title>Buku Populer</title>
    <!-- Tambahkan link ke file CSS atau styling jika diperlukan -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Buku Populer</h1>
    
    @if(count($topBooks) > 0)
        <ul>
            @foreach($topBooks as $book)
                <li>
                    <strong>{{ $book['judul'] }}</strong> - Rating: {{ $book['rating'] }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Tidak ada buku populer saat ini.</p>
    @endif
</body>
</html>

