<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__("Renting")}}</title>
</head>
<body>
<x-navbar />
    <div class="container">
        <h1>{{__("Your rented articles")}}</h1>
        <ul>
            @foreach ($rentingArticles as $ra)
                <li>
                    <strong>{{ $ra->user->name }}</strong> {{__("rented article")}} {{__("from")}} {{ date('d-m-Y', strtotime($ra->date_from)) }} {{__("to")}} {{ date('d-m-Y', strtotime($ra->date_to)) }}
                    <strong>{{ $ra->ad->title }}</strong>
                    <!-- <a href="{{ route('bidding.show', $ra) }}">{{ __('View') }}</a>-->
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>