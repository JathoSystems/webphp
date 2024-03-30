<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__("Bid")}}</title>
</head>

<body>
    <x-navbar />

    <div class="container">
        <h1>{{__("Bid")}}</h1>
        <p><strong>{{ $bidding->user->name }}</strong> {{__("bids")}} €{{ $bidding->price }} {{__("on")}}
            <strong>{{ $bidding->ad->title }}</strong>
        </p>
        <img src="/storage/images/{{ $bidding->ad->image_url }}" alt="{{ $bidding->ad->name }}">
        <div class="buttons">
            <a class="button blue-button" href="{{ route('bidding.edit', $bidding) }}">{{ __('Edit') }}</a>
            <form action="{{ route('bidding.destroy', $bidding) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="button red-button" type="submit">{{ __('Delete') }}</button>
            </form>
            <a class="button blue-button" href="{{ route('bidding.index') }}">{{ __('Back') }}</a>
        </div>
    </div>
</body>

</html>
