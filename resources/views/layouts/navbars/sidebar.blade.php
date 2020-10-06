<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
{{--      {{ __('PHYSIO4U') }}--}}<a class="navbar-brand align-items-center" href="#"><img src="{{ asset('images') }}/logo.png" alt="" style="width: 160px"></a>
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
{{--          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>--}}<i class="material-icons">account_box</i>
          <p>{{ __('Users Management') }}
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

          </ul>
        </div>
      </li>
        <li class="nav-item {{ ($activePage == 'modules' || $activePage == 'modules-management') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#moduleExample" aria-expanded="true">
                          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                <p>{{ __('Settings Management') }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse " id="moduleExample">
                <ul class="nav">



                    @can('add_modules','edit_modules', 'delete_roles')
                        <li class="nav-item{{ $activePage == 'modules-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('modules.index') }}">
                                <span class="sidebar-mini"> MM </span>
                                <span class="sidebar-normal"> {{ __('Modules Management') }} </span>
                            </a>
                        </li>
                    @endcan
                    @can('add_details','edit_details', 'delete_details')
                        <li class="nav-item{{ $activePage == 'details-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('details.index') }}">
                                <span class="sidebar-mini"> T </span>
                                <span class="sidebar-normal"> {{ __('Details Management') }} </span>
                            </a>
                        </li>
                    @endcan
                    @can('add_exercises','edit_exercises', 'delete_exercises')
                        <li class="nav-item{{ $activePage == 'exercises-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('exercises.index') }}">
                                <span class="sidebar-mini"> E </span>
                                <span class="sidebar-normal"> {{ __('Exercises Management') }} </span>
                            </a>
                        </li>
                    @endcan
{{--                        @can('add_objectives','edit_objectives', 'delete_objectives')--}}
{{--                            <li class="nav-item{{ $activePage == 'objectives-management' ? ' active' : '' }}">--}}
{{--                                <a class="nav-link" href="{{ route('objectives.index') }}">--}}
{{--                                    <span class="sidebar-mini"> OM </span>--}}
{{--                                    <span class="sidebar-normal"> {{ __('Objectives Management') }} </span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('add_equipments','edit_equipments', 'delete_equipments')--}}
{{--                            <li class="nav-item{{ $activePage == 'details-management' ? ' active' : '' }}">--}}
{{--                                <a class="nav-link" href="{{ route('details.index') }}">--}}
{{--                                    <span class="sidebar-mini"> EM </span>--}}
{{--                                    <span class="sidebar-normal"> {{ __('Equipments Management') }} </span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('add_muscles','edit_muscles', 'delete_muscles')--}}
{{--                            <li class="nav-item{{ $activePage == 'muscles-management' ? ' active' : '' }}">--}}
{{--                                <a class="nav-link" href="{{ route('muscles.index') }}">--}}
{{--                                    <span class="sidebar-mini"> MM </span>--}}
{{--                                    <span class="sidebar-normal"> {{ __('Muscles Management') }} </span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
                </ul>
            </div>
        </li>
        <li class="nav-item {{ ($activePage == 'patients' || $activePage == 'patients-management') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#patientsExample" aria-expanded="true">
                <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                <p>{{ __('Patients Management') }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse " id="patientsExample">
                <ul class="nav">



                    @can('add_patients','edit_patients', 'delete_patients')
                        <li class="nav-item{{ $activePage == 'patients-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('patients.index') }}">
                                <span class="sidebar-mini"> MM </span>
                                <span class="sidebar-normal"> {{ __('Patients Management') }} </span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>
        </li>

    </ul>
  </div>
</div>
