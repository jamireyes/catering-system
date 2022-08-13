<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo d-flex justify-content-center">
        {{-- <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a> --}}
        {{-- <a href="{{ route('welcome') }}" class="simple-text logo-normal">
            {{ config('app.name') }}
        </a> --}}
        <a href="{{ route('welcome') }}"><img class="my-3" src="../assets/img/banner.png" height="40" alt="Logo"></a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                <a href="{{ route('user.index') }}">
                    <i class="nc-icon nc-badge"></i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'package' ? 'active' : '' }}">
                <a href="{{ route('package.index') }}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Packages') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'inventory' ? 'active' : '' }}">
                <a href="{{ route('inventory.index') }}">
                    <i class="nc-icon nc-box-2"></i>
                    <p>{{ __('Inventory') }}</p>
                </a>
            </li>
            {{-- <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('Laravel examples') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
        </ul>
    </div>
</div>
