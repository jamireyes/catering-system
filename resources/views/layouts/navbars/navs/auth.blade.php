<nav id="nav-auth" class="navbar navbar-expand-lg navbar-absolute sticky-top navbar-transparent">
    <div class="navbar-wrapper">
        <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navigation">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item btn-rotate dropdown ml-auto">
                <a class="nav-link dropdown-toggle " href="http://example.com" id="navbarDropdownMenuLink2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{  Auth::user()->name }}
                </a>
                <div class="dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                    <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Settings') }}</a>
                        <a class="dropdown-item" onclick="document.getElementById('formLogOut').submit();">{{ __('Log out') }}</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
