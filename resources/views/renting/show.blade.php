<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Renting') }}</title>
</head>

<body>
    <x-navbar />
    <div class="container">
        <h1>{{ __('Show rented article') }}</h1>
        <table>
            <thead>
                <tr>
                    <th>{{ __('Item') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Date from') }}</th>
                    <th>{{ __('Date to') }}</th>
                    <th>{{ __('Return image') }}</th>
                    <th>{{ __('Damage') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $rentingArticle->ad->title }}</td>
                    <td>€{{ $rentingArticle->ad->price }}</td>
                    <td>{{ date('d-m-Y', strtotime($rentingArticle->date_from)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($rentingArticle->date_to)) }}</td>
                    <td>
                        @isset($rentingArticle->ad->image_upload)
                            <img src="/storage/images/{{ $rentingArticle->ad->image_upload }}" alt="{{ $rentingArticle->ad->title }}">
                        @else
                            {{ __('No image') }}
                        @endisset
                    </td>
                    <td>
                        {{ $rentingArticle->ad->slijtage }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
