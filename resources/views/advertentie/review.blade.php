<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Review') }}</title>
</head>
<body>
    <x-navbar />

    <div class="container center gap">
        <h1>{{ __('Place review') }}</h1>
        <form class="form" action="{{ route('advertentie.review', ['id' => $advertentie->id]) }}" method="post">
            @csrf
            <label for="remarks">{{ __('Remarks') }}:</label>
            <input type="text" name="remarks" id="remarks">

            {{-- Hidden field for product and user id --}}
            <input type="hidden" name="ad_id" value="{{ $advertentie->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button class="button blue-button" type="submit">{{ __('Save') }}</button>
        </form>
        <a class="button blue-button" href="{{ route('advertentie.show', $advertentie) }}">{{ __('Back') }}</a>
    </div>
</body>
</html>