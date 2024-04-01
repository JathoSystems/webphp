<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__("Renting")}}</title>
    <style>
        svg{
            height:20px;
        }
    </style>
</head>
<body>
<x-navbar />
    <div class="container">
        @if (!$hired_by_others)
            <h1>{{__("Your personal rented articles")}}</h1>
        @else
            <h1>{{__("Your rented articles")}}</h1>
        @endif
        
        @if ((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && !$hired_by_others)
            <a class="button blue-button" href="{{ route('renting.personal')}}">{{ __('Rented advertisements') }}</a>
        @elseif((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && $hired_by_others)
            <a class="button blue-button" href="{{ route('renting.index')}}">{{ __('My personal rentals') }}</a>
        @endif
        <br><br>
        <table>
            <thead>
                <tr>
                    @if ((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && $hired_by_others)
                        <th>{{ __('Hired by') }}</th>
                    @endif
                    <th>{{ __('Item') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Date from') }}</th>
                    <th>{{ __('Date to') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentingArticles as $ra)
                    <tr>
                        @if ((auth()->user()->hasRole("zakelijk") || auth()->user()->hasRole("particulier")) && $hired_by_others)
                            <td>{{ $ra->user->name }}</td>
                        @endif
                        <td>{{ $ra->ad->title }}</td>
                        <td>{{ $ra->ad->price }}</td>
                        <td>{{ date('d-m-Y', strtotime($ra->date_from)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($ra->date_to)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br><br>
        {{$rentingArticles->links()}}

    </div>
</body>
</html>