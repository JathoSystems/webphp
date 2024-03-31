<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Edit component') }}</title>
</head>

<body>
    <x-navbar />

    <div class="container center">
        <h1>{{ __('Edit component') }}</h1>

        <form class="form" action="{{ route('component.update', $component) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="order">{{ __('Position') }}</label>
            <input type="number" name="order" id="order" value="{{ $component->order }}">
            @if ($component->type == 'text')
                <label for="text">{{ __('Text') }}</label>
                <textarea name="text" id="text">{{ $component->text }}</textarea>
            @elseif($component->type == 'image')
                <label for="image">{{ __('Image') }}</label>
                <input type="file" name="image" id="image">
                <label for="image_alt">{{ __('Image alt') }}</label>
                <input type="text" name="image_alt" id="image_alt" value="{{ $component->image_alt }}">
            @elseif($component->type == 'featured_ads')
                <label for="ads">{{ __('Ads') }}</label>
                <p>{{ __('The content of this component can not be edited.') }}</p>
            @endif
            <button class="button blue-button" type="submit">{{ __('Edit') }}</button>
        </form>
    </div>
</body>

</html>
