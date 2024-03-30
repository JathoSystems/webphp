<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advertenties</title>
</head>

<body>
    <x-navbar />
    <div class="container">
    
    @if(!$favorieten)
        <h1>Advertenties</h1>
    @else
        <h1>Favoriete advertenties</h1>
    @endif
    @if(!$favorieten)
        @auth
            @if (auth()->user()->canAdvertise())
                <a class="button blue-button" href="{{ route('advertentie.create') }}">Advertentie toevoegen <i
                        class="fas fa-plus"></i></a>
            @endif
        @endauth
    @endif
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Omschrijving</th>
                <th>Prijs</th>
                <th>Foto</th>
                <th>Type</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($advertenties as $advertentie)
                <tr>
                    <td>{{ $advertentie->title }}</td>
                    <td>{{ $advertentie->description }}</td>
                    <td>{{ $advertentie->price }}</td>
                    @if ($favorieten)
                        @php
                            $img_src = "../storage/images/";
                        @endphp
                    @else
                        @php
                            $img_src = "storage/images/";
                        @endphp
                    @endif

                    <td><img src="{{ asset($img_src . $advertentie->image_url) }}" alt="{{ $advertentie->titel }}" style="width: 100px;"></td>
                    <td>
                        @if ($advertentie->type === 'verhuur_advertentie')
                            Verhuur advertentie
                        @else
                            Advertentie
                        @endif
                    </td>
                    <td>

                        @if(!$favorieten)
                            <form action="{{ route('advertentie.edit', $advertentie) }}" method="get">
                            @csrf
                            <button type="submit">Bewerken</button>
                            </form>
                            <form action="{{ route('advertentie.destroy', $advertentie) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">Verwijderen</button>
                            </form>
                        @endif
                        <form action="{{ route('advertentie.favorite', $advertentie) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="button">Favoriet</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
</body>

</html>
