<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Advertiser') }}</title>
</head>

<body>
    <x-navbar />

    <div class="container">

        <h1>{{ $advertiser->name }}</h1>
        <p>{{ $advertiser->email }}</p>
        <p>{{ $advertiser->price }}</p>
        <p>
            @if ($advertiser->hasRole("zakelijk"))
                {{ __('Business') }}
            @else
                {{ __('Private') }}
            @endif
        </p>

        <br>
        <div class="buttons">
            @auth
                @if ($advertiser->id !== auth()->id())
                    <a class="button blue-button"
                        href="{{ route('advertisers.review', ['id' => $advertiser->id]) }}">{{ __('Place review') }}</a>
                @endif
            @endauth
            <a class="button blue-button" href="{{ route('advertisers.index') }}">{{ __('Back to overview') }}</a>
        </div>

        <br><br>
        
        <h2>Reviews</h2>
        <table>
            <thead>
                <tr>
                    <th>{{ __('User') }}</th>
                    <th>{{ __('Remarks') }}</th>
                    <th>{{ __('Date created') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->remarks }}</td>
                        <td>{{ $review->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
