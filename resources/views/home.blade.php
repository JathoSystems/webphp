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

        <h1>{{ __('Welcome') }}</h1>

        <p>{{ __('Welcome to De Bazaar') }}</p>

        <div class="langs">
            <a href="{{ route('locale', 'nl') }}">NL</a>
            <a href="{{ route('locale', 'en') }}">EN</a>
            {{ App::getLocale() }}
        </div>

        <div class="container">
            {{-- Recent ads --}}
            <h2>{{ __('Recent ads') }}</h2>
            <div class="ads">
                @foreach ($advertenties as $advertentie)
                    <div class="ad">
                        <h3>{{ $advertentie->title }}</h3>
                        <p>{{ $advertentie->description }}</p>
                        <p>{{ $advertentie->price }}</p>
                        <img src="storage/images/{{ $advertentie->image_url }}" alt="{{ $advertentie->title }}"
                            style="width: 100px;">
                        <p>
                            @if ($advertentie->type === 'verhuur_advertentie')
                                {{ __('Rental ad') }}
                            @else
                                {{ __('Ad') }}
                            @endif
                        </p>
                        <a class="button blue-button" href="{{ route('advertentie.show', $advertentie) }}">{{ __('View') }}</a>
                    </div>
                @endforeach
                <div class="ad">
                    <div class="center">
                        <a class="button blue-button" href="/advertenties">{{ __('View more') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
