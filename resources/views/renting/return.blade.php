<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Return rented item') }}</title>
</head>

<body>
    <x-navbar />
    <div class="container center">
        <h1>{{ __('Return rented item') }}</h1>
        <form class="form" action="{{ route('renting.return', $renting) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="image_upload">{{ __("Image") }}</label>
            <input type="file" name="image_upload" id="image_upload">
            @error('image_upload')
                <p>{{ $message }}</p>
            @enderror

            <button class="button blue-button" type="submit">{{ __('Return') }}</button>
        </form>
        <a href="{{ route('renting.index') }}">{{ __('Back') }}</a>
    </div>
</body>

</html>
