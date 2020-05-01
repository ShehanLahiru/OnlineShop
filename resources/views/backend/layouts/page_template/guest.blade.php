<div class="wrapper wrapper-full-page ">
    @include('backend.layouts.navbars.navs.guest')
    <div class="full-page register-page section-image" filter-color="black" >
        @yield('content')
        @include('backend.layouts.footer')
    </div>
</div>
 {{-- backgroun image should add --}}
