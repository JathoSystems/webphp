<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advertentie</title>
</head>

<body>
    <x-navbar />

    <div class="container">

        <h1>{{ $advertentie->title }}</h1>
        <p>{{ $advertentie->description }}</p>
        <p>{{ $advertentie->price }}</p>
        <img src="/storage/images/{{ $advertentie->image_url }}" alt="{{ $advertentie->title }}">
        <p>
            @if ($advertentie->type === 'verhuur_advertentie')
                {{ __('Rental ad') }}
            @else
                {{ __('Ad') }}
            @endif
        </p>

        <div class="buttons">
            @auth
                @if ($advertentie->user_id === auth()->id())
                    <a class="button blue-button"
                        href="{{ route('advertentie.edit', $advertentie) }}">{{ __('Edit') }}</a>
                    <form action="{{ route('advertentie.destroy', $advertentie) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="button red-button" type="submit">{{ __('Delete') }}</button>
                    </form>
                @else
                    <a class="button blue-button"
                        href="{{ route('bidding.create', ['ad' => $advertentie->id]) }}">{{ __('Place bid') }}</a>
                @endif
            @endauth
            <a class="button blue-button" href="{{ route('advertentie.index') }}">{{ __('Back') }}</a>
        </div>

        <br><br>
        <h2>Delen</h2>
        {!! QrCode::size(100)->generate(url()->current()) !!}

    </div>

</body>

</html>
