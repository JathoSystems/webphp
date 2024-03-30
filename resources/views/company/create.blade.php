<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Company setup') }}</title>
</head>

<body>
    <x-navbar />
    <div class="container center gap">
        <h1>{{ __('Company setup') }}</h1>
        <form class="form" action="{{ route('company.create') }}" method="post">
            @csrf
            <label for="name">{{ __('Name') }}:</label>
            <input type="text" name="name" id="name" autocomplete="name">
            <label for="logo_url">{{ __('Logo URL') }}:</label>
            <input type="text" name="logo_url" id="logo_url">
            <label for="color_scheme">{{ __('Color scheme') }}:</label>
            <input type="hex" name="color_scheme" id="color_scheme">
            <button class="button blue-button" type="submit">{{ __('Register') }}</button>
        </form>
    </div>
</body>

</html>
