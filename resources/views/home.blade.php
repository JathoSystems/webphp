<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>De Bazaar</title>
</head>
<body>
    <x-navbar />

    <div class="container">

        <h1>{{__("Welcome")}}</h1>
    
        <p>{{__("Welcome to De Bazaar")}}</p>
    
        <div class="container">
            {{-- Recent ads --}}
            <h2>{{__("Recent ads")}}</h2>
            <div class="ads">
                @foreach ($advertenties as $advertentie)
                    <div class="ad">
                        <h3>{{ $advertentie->title }}</h3>
                        <p>{{ $advertentie->description }}</p>
                        <p>{{ $advertentie->price }}</p>
                        <img src="storage/images/{{ $advertentie->image_url }}" alt="{{ $advertentie->title }}" style="width: 100px;">
                        <p>
                            @if ($advertentie->type === 'verhuur_advertentie')
                                {{__("Rental ad")}}
                            @else
                                {{__("Ad")}}
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</body>
</html>