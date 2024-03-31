<link rel="stylesheet" href="/style.css">
<script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
<nav>
    <div class="brand">
        {{-- <img src="/images/logo.jpg" alt="Logo van De Bazaar"> --}}

        <h1>De Bazaar</h1>
    </div>
    <button class="menu-button" onclick="toggleNavbar()">Menu</button>
    <div class="links">
        <a href="/">{{ __("Home") }}</a>
        <a href="/advertenties">{{ __("Advertisements") }}</a>
        <a href="/bidding">{{ __("Bids") }}</a>
        <a href="/renting">{{ __("Rentings") }}</a>
        @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('zakelijk')))
            <a href="/contracts">{{ __("Contracts") }}</a>
        @endif

        <x-navbar-account-buttons />
    </div>
</nav>
<script src="/navbar.js"></script>
