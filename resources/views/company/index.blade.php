<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Companies') }}</title>
    <style>
        svg{
            height:20px;
        }
    </style>
</head>

<body>
    <x-navbar />

    <div class="container center">

        <h1>{{ __('Companies') }}</h1>
        <table>
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Color scheme') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->color_scheme }}</td>
                        <td class="buttons">
                            <a class="button blue-button" href="{{ route('company.show', $company->landing_page_url) }}">{{ __('Show') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br><br>
        {{$companies->links()}}
    </div>
</body>

</html>
