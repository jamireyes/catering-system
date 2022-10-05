<nav class="navbar navbar-expand-lg m-0 bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
    </button>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ route('welcome') }}" class="nav-link"><img src="../assets/img/banner.png" height="40" alt="Logo"></a>
        </li>
    </ul>
    
    <div style="background-color:transparent;width:37px;"></div>
    <div class="collapse navbar-collapse justify-content-between" id="navigation">
        <ul id="nav-right" class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{ route('checkout.index') }}" class="nav-link">
                    <i class="nc-icon nc-cart-simple mr-1"></i>{{ __('Cart') }}
                </a>
            </li>
            @guest
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">
                    <img src="{{ asset('assets') }}/img/svg/log-in.svg" alt="login" class="mr-2">{{ __('Login') }}
                </a>
            </li>
            @endguest
            @auth
            <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="nc-icon nc-single-02"></i>
                    {{ __('Account') }}
                </a>
                <div class="dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                    <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                        <a class="dropdown-item" onclick="document.getElementById('formLogOut').submit();">{{ __('Log out') }}</a>
                    </div>
                </div>
            </li>
            @endauth
        </ul>
    </div>
</nav>