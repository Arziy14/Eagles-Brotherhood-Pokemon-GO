<nav class="navbar bg-body-tertiary">
    <div class="header__container container">
        <div class="header__logo_container">
            <a class="navbar-brand" href="/home">
                <img src="{{asset('storage/images/pgo-logo.png')}}" alt="Store logo" class="header__logo">
            </a>
            <h1>Web Store</h1>
        </div>
        @auth
            <div class="header__btn_container">
                <button 
                    class="header__btn" 
                    type="submit"
                    onclick="window.location.href='/profile'">
                    Profile
                </button>
                <button 
                    class="header__btn" 
                    type="submit"
                    onclick="window.location.href='/cart'">
                    Cart
                </button>
                <button 
                    class="header__btn" 
                    type="submit"
                    onclick="window.location.href='/sign_out'">
                    Sign Out
                </button>
        @else
                <button 
                    class="header__btn" 
                    type="submit"
                    onclick="window.location.href='/sign_in'">
                    Sign In
                </button>
            </div>
        @endauth
    </div>
</nav>