<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <x-navbar />
    <div class="container center gap">
        <h1>Login</h1>
        <form class="form" action="{{ route('account.login') }}" method="post">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" autocomplete="username">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" autocomplete="current-password">
            <button class="button blue-button" type="submit">Login</button>
        </form>
        <a class="button blue-button" href="{{ route('register') }}">{{ __('Register') }}</a>
    </div>
    
</body>
</html>
