<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __("Company page") }}</title>
</head>

<body style="background-color: {{ $company->color_scheme }}">
    <x-navbar />
    <div class="container center gap">
        <div class="card">
            <h1>{{ __("Company page") }}</h1>
            <div class="company">
                <h2>{{ $company->name }}</h2>
                <img src="/storage/images/{{ $company->logo_url }}" alt="{{ $company->name }} logo" width="300">
                <p>{{ __("Color scheme") }}: <span style="color: {{ $company->color_scheme }}">{{ $company->color_scheme }}</span></p>
                <a href="{{ route('company.edit', ['company' => $company->id]) }}" class="button blue-button">{{ __("Edit") }}</a>
            </div>
        </div>
    </div>
</body>

</html>
