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
                    <h2>Advertenties informatie</h2>
                    <br>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="d-none d-lg-table-cell">Afbeelding</th>
                                <th scope="col">Titel</th>
                                <th scope="col">Omschrijving</th>
                                <th scope="col">Prijs</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <td class="py-2 px-4 border-bottom margin-auto">{{ $ad->title }}</td>
                                <td class="py-2 px-4 border-bottom">{{ $ad->description }}</td>
                                <td class="py-2 px-4 border-bottom">{{ $ad->price }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>


                    <h2>Biedingen</h2>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="d-none d-lg-table-cell">Prijs</th>
                                <th scope="col">Naam</th>
                                <th scope="col">Datum/tijd</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($adBiddings as $bidding)
                            <tr>
                                <td class="py-2 px-4 border-bottom margin-auto">{{ $bidding->price }}</td>
                                <td class="py-2 px-4 border-bottom margin-auto">{{ $bidding->user }}</td>
                                <td class="py-2 px-4 border-bottom">{{ $bidding->dateTime }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('biddings.create', ['adId' => $ad->id]) }}" class="btn btn-success">Bieden</a>


            </div>
        </div>
    </div>
</body>
</html>
