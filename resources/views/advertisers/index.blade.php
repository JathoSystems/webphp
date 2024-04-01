<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Advertisers') }}</title>
    <style>
        svg{
            height:20px;
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Private / Business') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($advertisers as $advertiser)
                    <tr>
                        <td>{{ $advertiser->name }}</td>
                        <td>{{ $advertiser->email }}</td>
                        <td>
                            @if ($advertiser->hasRole("zakelijk"))
                                {{ __('Business') }}
                            @else
                                {{ __('Private') }}
                            @endif
                        </td>
                        <td>
                            <div class="buttons">
                                <form action="{{ route('advertisers.show', $advertiser) }}" method="get">
                                    @csrf
                                    <button class="button" type="submit">{{ __('View') }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
        <!-- Pagination Links -->
        {{ $advertisers->links() }}


    </div>
</body>

</html>
