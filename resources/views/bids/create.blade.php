<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bieding maken</title>
</head>

<body>
    <x-navbar />

    <div class="container center gap">
        <h1>Bieding maken</h1>
        <form class="form" action="{{ route('bidding.store') }}" method="post">
            @csrf
            <label for="price">Bedrag:</label>
            <input type="number" name="price" id="price" step="0.01">
            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
            {{-- Hidden field for product and user id --}}
            <input type="hidden" name="ad_id" value="{{ $advertentie->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button class="button blue-button" type="submit">Opslaan</button>
        </form>
        <a class="button blue-button" href="{{ route('bidding.index') }}">{{ __('Back') }}</a>
    </div>

</body>

</html>
