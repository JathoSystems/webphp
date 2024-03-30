<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__("Edit advertisement")}}</title>
</head>

<body>
    <x-navbar />

    <div class="container">

        <h1>{{__("Edit advertisement")}}</h1>
        <form class="form" action="{{ route('advertentie.update', $advertentie) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <label for="type">{{__("Ad type")}}</label>
            <select name="type" id="type">
                <option value="verhuur_advertentie"
                    {{ $advertentie->type === 'verhuur_advertentie' ? 'selected' : '' }}>{{__("Rent advertisement")}}</option>
                <option value="advertentie" {{ $advertentie->type === 'advertentie' ? 'selected' : '' }}>{{__("Purchase advertisement")}}
                </option>
            </select>

            <label for="title">{{__("Title")}}</label>
            <input type="text" name="title" id="title" value="{{ $advertentie->title }}">
            @error('title')
                <p>{{ $message }}</p>
            @enderror

            <label for="description">{{__("Description")}}</label>
            <textarea name="description" id="description">{{ $advertentie->description }}</textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror

            <label for="price">{{__("Price")}}</label>
            <input type="number" name="price" id="price" value="{{ $advertentie->price }}" step=".01">
            @error('price')
                <p>{{ $message }}</p>
            @enderror

            <label for="expiration_date">{{__("Expiry date")}}</label>
            <input type="date" name="expiration_date" id="expiration_date"
                value="{{ $advertentie->expiration_date->format('Y-m-d') }}">
            @error('expiration_date')
                <p>{{ $message }}</p>
            @enderror

            <label for="image">{{__("Image")}}</label>
            <input type="file" name="image" id="image">
            @error('image')
                <p>{{ $message }}</p>
            @enderror


            {{-- Hidden field status="beschikbaar" --}}
            <input type="hidden" name="status" value="beschikbaar">
            {{-- Hidden field QR code, empty for now but we can generate it later --}}
            <input type="hidden" name="QR_code" value="N/A">
            {{-- Hidden field user_id, we can get this from the authenticated user --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <button class="button" type="submit">{{__("Save")}}</button>
        </form>
        <a class="button" href="{{ route('advertentie.index') }}">{{__("Back to overview")}}</a>
    </div>

</body>

</html>
