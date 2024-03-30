<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rollen</title>
</head>
<body>
    <x-navbar />
    <h1>Rollen</h1>
    <ul>
        @foreach ($roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('account.roles') }}">Terug</a>

    <a href="{{ route('account.editroles') }}">Rollen bewerken</a>
</body>
</html>