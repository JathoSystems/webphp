<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Add component') }}</title>
</head>

<body>
    <x-navbar />
    <div class="container center">
        <h1>{{ __('Add component') }}</h1>

        <form class="form" action="{{ route('component.store') }}" method="post">
            @csrf
            <label for="type">{{ __('Type') }}</label>
            <select name="type" id="type">
                <option value="text">{{ __('Text') }}</option>
                <option value="image">{{ __('Image') }}</option>
                <option value="featured_ads">{{ __('Featured ads') }}</option>
            </select>
            <label for="order">{{ __('Position') }}</label>
            <input type="number" name="order" id="order">
            <p>{{ __('The contents are editable after it is created') }}</p>
            <input type="hidden" name="company_id" value="{{ $company->id }}">
            <button class="button blue-button" type="submit">{{ __('Add') }}</button>
        </form>
    </div>
</body>

</html>
