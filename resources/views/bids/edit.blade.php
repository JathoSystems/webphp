<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__("Edit bid")}}</title>
</head>

<body>
    <x-navbar />


    <div class="container center gap">
        <div class="advertentie">
            @isset($advertentie)
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
            @else
                <p class="error">{{__("No adverisement found")}}</p>
            @endisset
        </div>
        <h1>{{__("Edit bid")}}</h1>
        <form class="form" action="{{ route('bidding.update', $bidding) }}" method="post">
            @csrf
            @method('PUT')
            <label for="price">{{__("Amount")}}:</label>
            <input type="number" name="price" id="price" value="{{ $bidding->price }}" step=".01">
            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
            <input type="hidden" name="ad_id" value="{{ $bidding->ad_id }}">
            <input type="hidden" name="user_id" value="{{ $bidding->user_id }}">
            <button class="button blue-button" type="submit">{{__("Save")}}</button>
        </form>
        <a class="button blue-button" href="{{ route('bidding.index') }}">{{ __('Back') }}</a>
    </div>

</body>

</html>
