
<form id="logout-form" action="{{ route('backend.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@include('backend.layouts.navbars.sidebar')
<div class="main-panel">
    @include('backend.layouts.navbars.navs.auth')
    @yield('content')
    @include('backend.layouts.footer')
</div>
