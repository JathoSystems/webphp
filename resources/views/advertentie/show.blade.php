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
        <p>€{{ $advertentie->price }}</p>
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
                    @if ($advertentie->expiration_date > now())
                        @if ($advertentie->type === 'verhuur_advertentie')
                        <a class="button blue-button"
                            href="{{ route('renting.create', ['ad' => $advertentie->id]) }}">{{ __('Hire item') }}</a>
                        @else
                        <a class="button blue-button"
                            href="{{ route('bidding.create', ['ad' => $advertentie->id]) }}">{{ __('Place bid') }}</a>
                        @endif

                        <br><br>

                        <a class="button blue-button"
                            href="{{ route('advertentie.review', ['id' => $advertentie->id]) }}">{{ __('Place review') }}</a>
                        <br>
                    @else
                        @if ($advertentie->expiration_date > now())
                            <a class="button blue-button"
                                href="{{ route('bidding.create', ['ad' => $advertentie->id]) }}">{{ __('Place bid') }}</a>
                        @endif
                    @endif

                @endif
            @endauth
            <a class="button blue-button" href="{{ route('advertentie.index') }}">{{ __('Back to overview') }}</a>
        </div>

        <br><br>
        @auth
            @if ($advertentie->type == 'verhuur_advertentie')
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
            @endif
        @endauth


        <h2>{{ __('Related advertisements') }}</h2>
        <div class="ads">
            @if ($related_advertenties->count() > 0)
                @foreach ($related_advertenties as $related_advertentie)
                    <div class="ad">
                        <h3>{{ $related_advertentie->title }}</h3>
                        <p>{{ $related_advertentie->description }}</p>
                        <p>€{{ $related_advertentie->price }}</p>
                        @if ($related_advertentie->image_url === null)
                            {{ __('No image') }}
                        @else
                            <img src="/storage/images/{{ $related_advertentie->image_url }}"
                                alt="{{ $related_advertentie->title }}">
                        @endif
                        <p>
                            @if ($advertentie->type === 'verhuur_advertentie')
                                {{ __('Rent advertisement') }}
                            @else
                                {{ __('Purchase advertisement') }}
                            @endif
                        </p>
                        <a class="button blue-button"
                            href="{{ route('advertentie.show', $related_advertentie->id) }}">{{ __('View') }}</a>
                        @auth
                            @if ($advertentie->user_id === auth()->id())
                                <form
                                    action="{{ route('advertentie.destroyRelated', [
                                        'id' => $advertentie->id,
                                        'related_advertentie_id' => $related_advertentie->id,
                                    ]) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="button red-button" type="submit">{{ __('Delete') }}</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @endforeach
            @else
                {{ __('No related advertisements') }}
            @endif
        </div>
        @auth
            @if ($advertentie->user_id === auth()->id())
                <a class="button blue-button"
                    href="{{ route('advertentie.createRelated', ['id' => $advertentie->id]) }}">{{ __('Create related advertisement') }}</a>
            @endif
        @endauth

        <br><br>
        <h2>{{ __('Share') }}</h2>
        {!! QrCode::size(100)->generate(url()->current()) !!}

    </div>

</body>

</html>
