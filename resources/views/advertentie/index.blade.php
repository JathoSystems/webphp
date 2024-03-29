<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advertenties</title>
</head>
<body>
    
    <h1>Advertenties</h1>
    <a href="{{ route('advertentie.create') }}">Advertentie toevoegen</a>
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
                    <td><img src="storage/images/{{ $advertentie->image_url }}" alt
                        ="{{ $advertentie->titel }}" style="width: 100px;"></td>
                    <td>
                        @if ($advertentie->type === 'verhuur_advertentie')
                            Verhuur advertentie
                        @else
                            Advertentie
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('advertentie.edit', $advertentie) }}">Bewerken</a>
                        <form action="{{ route('advertentie.destroy', $advertentie) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>