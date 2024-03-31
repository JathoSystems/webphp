<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Company page') }}</title>
</head>

<body style="background-color: {{ $company->color_scheme }}">
    <x-navbar />
    <div class="container center gap">
        <div class="card">
            <h1>{{ __('Company page') }}</h1>
            <div class="company">
                <h2>{{ $company->name }}</h2>
                <img src="/storage/images/{{ $company->logo_url }}" alt="{{ $company->name }} logo" width="300">
                <p>{{ __('Color scheme') }}: <span
                        style="color: {{ $company->color_scheme }}">{{ $company->color_scheme }}</span></p>
                <a href="{{ route('company.edit', ['company' => $company->id]) }}"
                    class="button blue-button">{{ __('Edit') }}</a>
                <a href="{{ route('component.index', ['company_id' => $company->id]) }}"
                    class="button blue-button">{{ __('Components') }}</a>
            </div>
        </div>
        @foreach ($components as $component)
            <div class="featured">
                <div class="card">
                    @if ($component->type == 'text')
                        <p>{{ $component->text }}</p>
                    @elseif ($component->type == 'image')
                        <img src="/storage/images/{{ $component->image_url }}" alt="{{ $component->image_alt }}">
                    @elseif ($component->type == 'featured_ads')
                        <h2>{{ __('Featured ads') }}</h2>
                        <div class="ads">
                            @foreach ($company->user->advertenties as $ad)
                                <div class="ad">
                                    @isset($ad->image_url)
                                        <img src="/storage/images/{{ $ad->image_url }}" alt="{{ $ad->title }}">
                                    @else
                                        <p><i>{{ __('No image') }}</i></p>
                                    @endisset
                                    <h3>{{ $ad->title }}</h3>
                                    <p>{{ $ad->description }}</p>
                                    <a href="{{ route('advertentie.show', $ad) }}"
                                        class="button blue-button">{{ __('View') }}</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
