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
        @isset($error)
            <p>{{ $error }}</p>
        @endisset
        @error('error')
            <p>{{ $message }}</p>
        @enderror
        <h1>{{ __('Company setup') }}</h1>
        <form class="form" action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">{{ __('Name') }}:</label>
            <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name') }}">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
            <label for="logo">{{ __('Logo') }}:</label>
            <input type="file" name="logo" id="logo">
            @error('logo')
                <p>{{ $message }}</p>
            @enderror
            <label for="color_scheme">{{ __('Color scheme') }}:</label>
            <input type="color" name="color_scheme" id="color_scheme" value="{{ old('color_scheme') }}">
            @error('color_scheme')
                <p>{{ $message }}</p>
            @enderror

            {{-- Hidden fields for user id and landing page url --}}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="landing_page_url" value="/">

            @error('user_id')
                <p>{{ $message }}</p>
            @enderror
            @error('landing_page_url')
                <p>{{ $message }}</p>
            @enderror

            <button class="button blue-button" type="submit">{{ __('Register') }}</button>
        </form>
    </div>
</body>

</html>
