@auth
    <a href="{{ route('account.roles') }}">{{ __('Roles') }}</a>
    <form action="{{ route('account.logout') }}" method="post">
        @csrf
        <button class="nav-item" type="submit">{{ __('Logout') }}</button>
    </form>
@endauth
@guest
    <a href="{{ route('account.login') }}">{{ __('Login') }}</a>
    <a href="{{ route('account.register') }}">{{ __('Register') }}</a>
@endguest