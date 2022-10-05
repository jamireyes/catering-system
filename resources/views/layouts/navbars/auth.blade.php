<div class="sidebar" data-color="black" data-active-color="warning">
    <div class="logo d-flex justify-content-center">
        <a href="{{ route('welcome') }}"><img class="my-3" src="{{ asset('assets') }}/img/banner.png" height="40" alt="Logo"></a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if (Auth::user()->role == 'ADMIN' | Auth::user()->role == 'SELLER')
                <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'ADMIN')
                    <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}">
                            <i class="nc-icon nc-badge"></i>
                            <p>{{ __('Users') }}</p>
                        </a>
                    </li> 
                @endif
                <li class="{{ $elementActive == 'package' ? 'active' : '' }}">
                    <a href="{{ route('package.index') }}">
                        <i class="nc-icon nc-box"></i>
                        <p>{{ __('Packages') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'item' || $elementActive == 'category' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#inventoryNav">
                        <i class="nc-icon nc-box-2"></i>
                        <p class="d-flex justify-content-between align-items-center">
                            {{ __('Inventory') }}
                            <span class="caret" style="top:auto;"></span>
                        </p>
                    </a>
                    <div class="collapse show" id="inventoryNav">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'item' ? 'active' : '' }}">
                                <a href="{{ route('item.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Package Items') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'category' ? 'active' : '' }}">
                                <a href="{{ route('category.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Package Category') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @else
                <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}">
                        <i class="nc-icon nc-badge"></i>
                        <p>{{ __('User Profile') }}</p>
                    </a>
                </li>
            @endif
            <li class="{{ $elementActive == 'order' ? 'active' : '' }}">
                <a href="{{ route('order.index') }}">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>{{ __('Order History') }}</p>
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
