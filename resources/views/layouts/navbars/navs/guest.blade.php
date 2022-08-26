<nav class="navbar navbar-expand-lg py-4 m-0 bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </button>
        <div class="navbar-wrapper">
            <a href="{{ route('welcome') }}"><img src="../assets/img/banner.png" height="40" alt="Logo"></a>
        </div>
        
        <div style="background-color:transparent;width:37px;"></div>
        <div class="collapse navbar-collapse justify-content-between" id="navigation">
            <ul id="nav-right" class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('checkout.index') }}" class="nav-link text-uppercase">{{ __('Cart') }}</a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link text-uppercase">
                        {{ __('Login') }}
                    </a>
                </li>
                @endguest
                @auth
                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link text-uppercase dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Account') }}
                    </a>
                    <div class="dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                        <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-uppercase" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                            <a class="dropdown-item text-uppercase" onclick="document.getElementById('formLogOut').submit();">{{ __('Log out') }}</a>
                        </div>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>