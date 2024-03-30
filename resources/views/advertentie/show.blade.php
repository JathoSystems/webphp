<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Advertisement') }}</title>
</head>

<body>
    <x-navbar />

    <div class="container">

        <h1>{{ $advertentie->title }}</h1>
        <p>{{ $advertentie->description }}</p>
        <p>{{ $advertentie->price }}</p>
        @if ($advertentie->image_url === null)
            {{ __('No image') }}
        @else
            <img src="/storage/images/{{ $advertentie->image_url }}" alt="{{ $advertentie->title }}">
        @endif
        <p>
            @if ($advertentie->type === 'verhuur_advertentie')
                {{ __('Rent advertisement') }}
            @else
                {{ __('Purchase advertisement') }}
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

                    @if($advertentie->type == "verhuur_advertentie")
                    <a class="button blue-button"
                        href="{{ route('renting.create', ['ad' => $advertentie->id]) }}">{{ __('Hire item') }}</a>
                    @else
                    <a class="button blue-button"
                        href="{{ route('bidding.create', ['ad' => $advertentie->id]) }}">{{ __('Place bid') }}</a>
                    @endif
                    
                @endif
            @endauth
            <a class="button blue-button" href="{{ route('advertentie.index') }}">{{ __('Back to overview') }}</a>
        </div>

        <br><br>
        <h2>{{ __('Share') }}</h2>
        {!! QrCode::size(100)->generate(url()->current()) !!}

    </div>

</body>

</html>
