<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__("Bids")}}</title>
</head>

<body>
    <x-navbar />
    <div class="container">
        <h1>{{__("Your bids")}}</h1>
        <ul>
            @foreach ($bids as $bid)
                <li>
                    <strong>{{ $bid->user->name }}</strong> {{__("bids")}} €{{ $bid->price }} {{__("on")}}
                    <strong>{{ $bid->ad->title }}</strong>
                    <a href="{{ route('bidding.show', $bid) }}">{{ __('View') }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
