<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Create related ad') }}</title>
</head>

<body>
    <x-navbar />

    <div class="container center">
        <h1>{{ __('Create related ad') }}</h1>

        <form class="form" action="{{ route('advertentie.storeRelated') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="advertentie_id" value="{{ $advertentie->id }}">
            <label for="related_advertentie_id">{{ __('Advertentie') }}</label>
            @isset($advertenties)
            <select name="related_advertentie_id" id="related_advertentie_id">
                @foreach ($advertenties as $ad)
                <option value="{{$ad->id}}">{{$ad->title}}</option>
                @endforeach
            </select>
            @else
            <p>{{ __('No ads to choose from') }}</p>
            @endisset
            <button class="button blue-button" type="submit">{{ __('Create') }}</button>
        </form>
    </div>
</body>

</html>
