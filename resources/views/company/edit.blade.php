<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Edit company') }}</title>
</head>

<body>
    <x-navbar />
    <div class="container center gap">
        <h1>{{ __('Edit company') }}</h1>
        <form class="form" action="{{ route('company.update', $company) }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">{{ __('Name') }}:</label>
            <input type="text" name="name" id="name" value="{{ $company->name }}" autocomplete="name">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
            <label for="logo">{{ __('Logo') }}:</label>
            <input type="file" name="logo" id="logo">
            @error('logo')
                <p>{{ $message }}</p>
            @enderror
            <label for="color_scheme">{{ __('Color scheme') }}:</label>
            <input type="color" name="color_scheme" id="color_scheme" value="{{ $company->color_scheme }}">
            @error('color_scheme')
                <p>{{ $message }}</p>
            @enderror
            <label for="landing_page_url">{{ __('Landing page URL') }}</label>
            <input type="text" name="landing_page_url" value="{{ $company->landing_page_url }}">
            <p>{{ __('The custom landing page url will be: ')}}<i>{{ explode('/%20', route('company.show', ['url' => ' ']))[0] . __('/[Your input]') }}</i></p>
            @error('landing_page_url')
                <p>{{ $message }}</p>
            @enderror
            <button class="button blue-button" type="submit">{{ __('Edit') }}</button>
        </form>
    </div>
</body>

</html>
