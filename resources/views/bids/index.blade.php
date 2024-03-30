<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biedingen</title>
</head>

<body>
    <x-navbar />
    <div class="container">
        <h1>Biedingen</h1>
        <ul>
            @foreach ($bids as $bid)
                <li>
                    <strong>{{ $bid->user->name }}</strong> biedt €{{ $bid->price }} op
                    <strong>{{ $bid->ad->title }}</strong>
                    <a href="{{ route('bidding.show', $bid) }}">{{ __('View') }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
