<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advertentie bijwerken</title>
</head>
<body>
    <h1>Advertentie bijwerken</h1>
    <form action="{{ route('advertentie.update', $advertentie) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="title">Titel</label>
        <input type="text" name="title" id="title" value="{{ $advertentie->title }}">
        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <label for="description">Omschrijving</label>
        <textarea name="description" id="description">{{ $advertentie->description }}</textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <label for="price">Prijs</label>
        <input type="number" name="price" id="price" value="{{ $advertentie->price }}">
        @error('price')
            <p>{{ $message }}</p>
        @enderror

        <label for="expiration_date">Vervaldatum</label>
        <input type="date" name="expiration_date" id="expiration_date" value="{{ $advertentie->expiration_date->format('Y-m-d') }}">
        @error('expiration_date')
            <p>{{ $message }}</p>
        @enderror

        <label for="image">Afbeelding</label>
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

        <button type="submit">Opslaan</button>
    </form>
    <a href="{{ route('advertentie.index') }}">Terug naar overzicht</a>
</body>
</html>