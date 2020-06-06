<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('PHYSIO4U') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Management') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse " id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
              @can('add_users','edit_users', 'delete_users')
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
                  @endcan
              @can('add_roles','edit_roles', 'delete_roles')
              <li class="nav-item{{ $activePage == 'roles-management' ? ' active' : '' }}">
                  <a class="nav-link" href="{{ route('roles.index') }}">
                      <span class="sidebar-mini"> RM </span>
                      <span class="sidebar-normal"> {{ __('Roles & Permissions') }} </span>
                  </a>
              </li>
                  @endcan
              @can('add_modules','edit_modules', 'module_roles')
                  <li class="nav-item{{ $activePage == 'modules-management' ? ' active' : '' }}">
                      <a class="nav-link" href="{{ route('modules.index') }}">
                          <span class="sidebar-mini"> MM </span>
                          <span class="sidebar-normal"> {{ __('Modules Management') }} </span>
                      </a>
                  </li>
              @endcan
          </ul>
        </div>
      </li>

    </ul>
  </div>
</div>
