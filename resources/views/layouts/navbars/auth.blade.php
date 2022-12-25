<div class="sidebar" data-color="black" data-active-color="warning">
    <div class="logo d-flex justify-content-center">
        <a href="{{ route('welcome') }}"><img class="my-3" src="{{ asset('assets') }}/img/banner.png" height="40" alt="Logo"></a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            
            @if (Auth::user()->role == 'SELLER')
                <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
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
                    <div class="collapse" id="inventoryNav">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'item' ? 'active' : '' }}">
                                <a href="{{ route('item.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Items') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'category' ? 'active' : '' }}">
                                <a href="{{ route('category.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Category') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'occasion' ? 'active' : '' }}">
                                <a href="{{ route('occasion.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Occasions') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'voucher' ? 'active' : '' }}">
                    <a href="{{ route('voucher.index') }}">
                        <i class="nc-icon nc-tag-content"></i>
                        <p>{{ __('Vouchers') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'team' ? 'active' : '' }}">
                    <a href="{{ route('team.index') }}">
                        <i class="fa-solid fa-user-tie"></i>
                        <p>{{ __('Team') }}</p>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'ADMIN')
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
                <li class="{{ $elementActive == 'item' || $elementActive == 'category' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#inventoryNav">
                        <i class="nc-icon nc-box-2"></i>
                        <p class="d-flex justify-content-between align-items-center">
                            {{ __('Inventory') }}
                            <span class="caret" style="top:auto;"></span>
                        </p>
                    </a>
                    <div class="collapse" id="inventoryNav">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'item' ? 'active' : '' }}">
                                <a href="{{ route('item.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Items') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'category' ? 'active' : '' }}">
                                <a href="{{ route('category.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Category') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'occasion' ? 'active' : '' }}">
                                <a href="{{ route('occasion.index') }}" class="d-flex align-items-center">
                                    <span class="sidebar-mini-icon d-flex justify-content-center">
                                        <svg viewBox="0 0 24 24" height="1rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                                    </span>
                                    <span class="sidebar-normal">{{ __('Occasions') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->role == 'USER')
                <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}">
                        <i class="nc-icon nc-badge"></i>
                        <p>{{ __('User Profile') }}</p>
                    </a>
                </li>
            @endif
            <li class="{{ $elementActive == 'order' ? 'active' : '' }}">
                <a href="{{ route('order.index') }}">
                    <i class="fa-regular fa-file-lines"></i>
                    <p>{{ __('Order History') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
