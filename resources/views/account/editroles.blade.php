<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rollen bewerken</title>
</head>
<body>
    <x-navbar />
    <h1>Rollen bewerken</h1>
    <form action="{{ route('account.updateroles') }}" method="post">
        @csrf
        @foreach ($roles as $role)
            <div>
                <input type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}" {{ $role->selected ? 'checked' : '' }}>
                <label for="role{{ $role->id }}">{{ $role->name }}</label>
            </div>
        @endforeach
        <button type="submit">Opslaan</button>
    </form>

    <a href="{{ route('account.roles') }}">Terug</a>
</body>
</html>
