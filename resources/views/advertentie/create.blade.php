<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advertenties</title>
</head>

<body>
    <h1>Advertentie toevoegen</h1>
    <form action="{{ route('advertentie.store') }}" method="post">
        @csrf
        <label for="titel">Titel</label>
        <input type="text" name="titel" id="titel" value="{{ old('titel') }}">
        @error('titel')
            <p>{{ $message }}</p>
        @enderror

        <label for="omschrijving">Omschrijving</label>
        <textarea name="omschrijving" id="omschrijving">{{ old('omschrijving') }}</textarea>
        @error('omschrijving')
            <p>{{ $message }}</p>
        @enderror

        <label for="prijs">Prijs</label>
        <input type="number" name="prijs" id="prijs" value="{{ old('prijs') }}">
        @error('prijs')
            <p>{{ $message }}</p>
        @enderror

        {{-- <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto"> --}}
        @error('foto')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Opslaan</button>
    </form>
    <a href="{{ route('advertentie.index') }}">Terug naar overzicht</a>
</body>

</html>
