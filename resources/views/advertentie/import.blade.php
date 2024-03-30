<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertenties importeren</title>
</head>
<body>
    <x-navbar />

    <div class="container">

        <h1>Advertenties importeren</h1>

        @if ($errors->any())
            <div>
                <strong>Whoops!</strong> Er was een probleem met de ingediende gegevens.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('advertentie.importAdvertenties') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="csv_file">
            <button type="submit">Uploaden</button>
        </form>
        <br>

        <a class="button" href="{{ route('advertentie.index') }}">Terug naar overzicht</a>
    </div>
</body>
</html>