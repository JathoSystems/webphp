<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <x-navbar />
    <div class="container center gap">
        <h1>Register</h1>
        <form class="form" action="{{ route('register') }}" method="post">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" autocomplete="name">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" autocomplete="username">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" autocomplete="new-password">
            <label for="password_confirmation">Confirm password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password">
            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="user">{{ __("User (no advertising)") }}</option>
                <option value="particulier">{{ __("User (with advertising)") }}</option>
                <option value="zakelijk">{{ __("Business (with advertising)") }}</option>
            </select>
            <button class="button blue-button" type="submit">Register</button>
        </form>
        <a class="button blue-button" href="{{ route('account.login') }}">{{ __('Login') }}</a>
    </div>
</body>
</html>