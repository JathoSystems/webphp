<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedingen</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="py-6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <br>
                    <h2>Bieding advertenties overzicht</h2>
                    <br>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="d-none d-lg-table-cell">Afbeelding</th>
                                <th scope="col">ID</th>
                                <th scope="col">Titel</th>
                                <th scope="col">Omschrijving</th>
                                <th scope="col">Prijs</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ads as $ad)
                                @php
                                    $image = isset($ad['image']) ? json_decode(trim(html_entity_decode($ad['image'])), true) : null;
                                @endphp
                                <tr>
                                    <td class="py-2 px-4 border-bottom d-none d-lg-table-cell">
                                        @if ($image)
                                            <!-- Gebruik $image in je HTML of Blade-code -->
                                            <img src="{{ Storage::disk('content_CMS')->url($image['url']) }}" alt="image" style="height: 15vh; width: 20vw;">
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-bottom margin-auto">{{ $ad->id }}</td>
                                    <td class="py-2 px-4 border-bottom margin-auto">{{ $ad->title }}</td>
                                    <td class="py-2 px-4 border-bottom">{{ $ad->description }}</td>
                                    <td class="py-2 px-4 border-bottom">{{ $ad->price }}</td>
                                    <td class="py-2 px-4 border-bottom text-center">
                                        <div class="d-flex">
                                        <a href="{{ route('biddings.show', $ad->id) }}" class="btn btn-primary">Bieden</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <!-- Toon de pagineringlinks -->
                    {{ $ads->links() }}

                    <!-- Toon de "Volgende" en "Vorige" knoppen -->
                    <div class="d-flex justify-content-between mt-4">
                        @if ($ads->onFirstPage())
                            <span></span> <!-- Geen "Vorige" knop als het de eerste pagina is -->
                        @else
                            <a href="{{ $ads->previousPageUrl() }}" class="text-blue-500">&larr; Vorige</a>
                        @endif

                        @if ($ads->hasMorePages())
                            <a href="{{ $ads->nextPageUrl() }}" class="text-blue-500">Volgende &rarr;</a>
                        @else
                            <span></span> <!-- Geen "Volgende" knop als het de laatste pagina is -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
