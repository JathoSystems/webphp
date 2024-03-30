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
    <div class="container center gap">

        <h1>Rollen</h1>
        <ul>
            @foreach ($roles as $role)
                <li>{{ $role->name }}</li>
            @endforeach
        </ul>

        <a class="button blue-button" href="{{ route('account.roles') }}">Terug</a>

        <a class="button blue-button" href="{{ route('account.editroles') }}">Rollen bewerken</a>
    </div>
</body>

</html>
