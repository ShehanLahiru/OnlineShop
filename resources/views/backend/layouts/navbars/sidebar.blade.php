<div class="sidebar" data-color="orange">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="{{route('backend.home')}}" class="simple-text logo-normal">
            {{ __('Ranwala APP Backend') }}
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="@if ($activePage == 'home') active @endif">
                <a href="{{ route('backend.home') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'shops') active @endif">
                <a href="{{ route('backend.shops.index') }}">
                    <i class="fas fa-music"></i>
                    <p>{{ __('Shops') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
