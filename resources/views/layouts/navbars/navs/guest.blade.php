<nav class="navbar navbar-expand-lg fixed-top py-4 mt-0">
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
            <ul id="nav-left" class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Store') }}</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('About') }}</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Contact Us') }}</a>
                </li>
            </ul>
            <ul id="nav-right" class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Cart') }}</a>
                </li>
                @guest
                    <li class="nav-item active">
                        <a href="{{ route('login') }}" class="nav-link">
                            {{ __('Login') }}
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item btn-rotate dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    </div>
</nav>