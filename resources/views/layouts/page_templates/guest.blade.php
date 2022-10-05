@include('layouts.navbars.navs.guest')

<div class="wrapper wrapper-full-page">
    <div class="container-fluid">
        <div class="px-2 py-4">
            @yield('content')
        </div>
    </div>
    {{-- @include('layouts.footer') --}}
</div>
