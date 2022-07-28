@include('layouts.navbars.navs.guest')

<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" data-image="{{ $backgroundImagePath }}" style="height:100vh;!important" filter-color="black">
        @yield('content')
        {{-- @include('layouts.footer') --}}
    </div>
</div>
