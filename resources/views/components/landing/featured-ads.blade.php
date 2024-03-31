<div class="featured">
    <div class="card">
        <h2>{{ __('Featured ads') }}</h2>
        <div class="ads">
            @foreach ($ads as $ad)
                <div class="ad">
                    @isset($ad->image_url)
                        <img src="/storage/images/{{ $ad->image_url }}" alt="{{ $ad->title }}">
                    @else
                        <p><i>{{ __('No image') }}</i></p>
                    @endisset
                    <h3>{{ $ad->title }}</h3>
                    <p>{{ $ad->description }}</p>
                    <a href="{{ route('advertentie.show', $ad) }}" class="button blue-button">{{ __('View') }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
