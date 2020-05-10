<div class="sidebar" data-color="orange">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="{{route('backend.home')}}" class="simple-text logo-normal">
            {{ __('Online Shopping Backend') }}
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
            <li class="@if ($activePage == 'items') active @endif">
                <a href="{{ route('backend.items.index') }}">
                    <i class="fas fa-spray-can"></i>
                    <p>{{ __('Items') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'shops') active @endif">
                <a href="{{ route('backend.shops.index') }}">
                    <i class="fas fa-home"></i>
                    <p>{{ __('Shops') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'categories') active @endif">
                <a href="{{ route('backend.categories.index') }}">
                    <i class="fas fa-tags"></i>
                    <p>{{ __('Categories') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'users') active @endif">
                <a href="{{ route('backend.users.index') }}">
                    <i class="fas fa-user"></i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'customers') active @endif">
                <a href="{{ route('backend.getcustomers') }}">
                    <i class="fas fa-user"></i>
                    <p>{{ __('Customers') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
