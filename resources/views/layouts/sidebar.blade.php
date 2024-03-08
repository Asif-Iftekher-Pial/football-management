<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('logo/header.png') }}" class="test" style="    max-width: 115%;
            height: auto;
            margin-left: -12px;
            margin-bottom: 5px;" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    {{-- <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="index.html">Dashboard 1</a>
                        </li>
                        <li>
                            <a href="index2.html">Dashboard 2</a>
                        </li>
                        <li>
                            <a href="index3.html">Dashboard 3</a>
                        </li>
                        <li>
                            <a href="index4.html">Dashboard 4</a>
                        </li>
                    </ul> --}}
                </li>
                <li style="display:{{ haveAllRoles_super_admin() ? '' : 'none' }}">
                    <a href="{{ route('roles-permissions.index') }}">
                        <i class="far fa-check-square"></i>Users & Roles</a>
                </li>
                
                @if(auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner'))
                <li>
                    <a href="{{ route('football-group-staff.index') }}">
                        <i class="fas fa-chart-bar"></i>Football Group Staff</a>
                </li>

                @else
                @endif

                @if(auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner'))
                <li>
                    <a href="{{ route('group-partner.index') }}">
                        <i class="fas fa-chart-bar"></i>Football Group Partner</a>
                </li>

                @else
                @endif

                @if (auth()->user()->hasRole('player') || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner') )
                    <li>
                        <a href="{{ route('player.index') }}"><i class="fa fa-users"></i>Players</a>
                    </li>
                @else
                    
                @endif
                @if ( auth()->user()->hasRole('manager') || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner'))
                <li>
                    <a href="{{ route('manager.index') }}"><i class="fas fa-user"></i>Manager</a>
                </li>
                @else
                    
                @endif

                @if ( auth()->user()->hasRole('other_football_job') || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner'))
                <li>
                    <a href="{{ route('other-football-job.index') }}"><i class="fas fa-user"></i>Other Football Job</a>
                </li>
                @else
                    
                @endif
               
               
               
               
               
                
                {{-- <li>
                    <a href="calendar.html">
                        <i class="fas fa-calendar-alt"></i>Calendar</a>
                </li>
                <li>
                    <a href="map.html">
                        <i class="fas fa-map-marker-alt"></i>Maps</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Pages</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="login.html">Login</a>
                        </li>
                        <li>
                            <a href="register.html">Register</a>
                        </li>
                        <li>
                            <a href="forget-pass.html">Forget Password</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-desktop"></i>UI Elements</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="button.html">Button</a>
                        </li>
                        <li>
                            <a href="badge.html">Badges</a>
                        </li>
                        <li>
                            <a href="tab.html">Tabs</a>
                        </li>
                        <li>
                            <a href="card.html">Cards</a>
                        </li>
                        <li>
                            <a href="alert.html">Alerts</a>
                        </li>
                        <li>
                            <a href="progress-bar.html">Progress Bars</a>
                        </li>
                        <li>
                            <a href="modal.html">Modals</a>
                        </li>
                        <li>
                            <a href="switch.html">Switchs</a>
                        </li>
                        <li>
                            <a href="grid.html">Grids</a>
                        </li>
                        <li>
                            <a href="fontawesome.html">Fontawesome Icon</a>
                        </li>
                        <li>
                            <a href="typo.html">Typography</a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>