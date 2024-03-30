<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Rent article') }}</title>
</head>

<body>
    <x-navbar />
    <div class="container center gap">
        <div class="advertentie">
            @isset($advertentie)
                <h1>{{ $advertentie->title }}</h1>
                <p>{{ $advertentie->description }}</p>
                <p>{{ $advertentie->price }}</p>
                @if ($advertentie->image_url === null)
                    <p>{{ __('No image') }}</p>
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
            @else
                <p class="error">{{ __('Adverisement not found') }}</p>
            @endisset
        </div>
        <h1>{{ __('Rent article') }}</h1>
        <form class="form" action="{{ route('renting.store') }}" method="post">
            @csrf
            <label for="date_from">{{ __('Date from') }}:</label>
            <input type="date" name="date_from" id="date_from">
            @error('date_from')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="date_to">{{ __('Date to') }}:</label>
            <input type="date" name="date_to" id="date_to">
            @error('date_to')
                <p class="error">{{ $message }}</p>
            @enderror

            {{-- Hidden field for product and user id --}}
            <input type="hidden" name="ad_id" value="{{ $advertentie->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button class="button blue-button" type="submit">{{ __('Save') }}</button>
        </form>
        <a class="button blue-button" href="{{ route('renting.index') }}">{{ __('Back') }}</a>
    </div>

</body>

</html>
