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
        @if (!$others_bids)
            <h1>{{__("Your bids")}}</h1>
        @else
            <h1>{{__("Bids on your products")}}</h1>
        @endif
        
        @if ((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && !$others_bids)
            <a class="button blue-button" href="{{ route('bidding.othersBids')}}">{{ __('Bids on your products') }}</a>
        @elseif((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && $others_bids)
            <a class="button blue-button" href="{{ route('bidding.index')}}">{{ __('My personal bids') }}</a>
        @endif
        <br><br>
        <table>
            <thead>
                <tr>
                    @if ((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && $others_bids)
                        <th>{{ __('Bid made by') }}</th>
                    @endif
                    <th>{{ __('Item') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Bid added on') }}</th>
                    <th>{{ __('Advertisement expires on') }}</th>
                    <th>{{ __('Highest bid') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bids as $bid)
                    <tr>
                        @if ((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && $others_bids)
                            <td>{{ $bid->user->name }}</td>
                        @endif
                        <td>{{ $bid->ad->title }}</td>
                        <td>{{ $bid->price }}</td>
                        <td>{{ $bid->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $bid->ad->expiration_date->format('d-m-Y H:i') }}</td>
                        <td>
                        @if($bid->isHighestBid($bid->ad_id, $bid->price) == 1)
                            {{ __('Yes') }}
                        @else
                            {{ __('No') }}
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br><br>
        {{$bids->links()}}

    </div>
</body>

</html>
