<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('logo/header.png') }}" alt="Cool Admin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    {{-- <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="index.html">Dashboard</a>
                        </li>
                    </ul> --}}
                </li>
                <li style="display:{{ haveAllRoles_super_admin() ? '' : 'none' }}">
                    <a href="{{ route('roles-permissions.index') }}">
                        <i class="far fa-check-square"></i>Users & Roles</a>
                </li>
                @if (auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner'))
                    <li>
                        <a href="{{ route('football-group-staff.index') }}">
                            <i class="fas fa-chart-bar"></i>Football Group Staff</a>
                    </li>
                @else
                @endif

                @if (auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner'))
                    <li>
                        <a href="{{ route('group-partner.index') }}">
                            <i class="fas fa-chart-bar"></i>Football Group Partner</a>
                    </li>
                @else
                @endif
                @if (auth()->user()->hasRole('player') ||
                        auth()->user()->hasRole('football_group_staff') ||
                        auth()->user()->hasRole('partner'))
                    <li>
                        <a href="{{ route('player.index') }}"><i class="fa fa-users"></i>Players</a>
                    </li>
                @else
                @endif
                @if (auth()->user()->hasRole('manager') ||
                        auth()->user()->hasRole('football_group_staff') ||
                        auth()->user()->hasRole('partner'))
                    <li>
                        <a href="{{ route('manager.index') }}"><i class="fas fa-user"></i>Manager</a>
                    </li>
                @else
                @endif

                @if (auth()->user()->hasRole('other_football_job') ||
                        auth()->user()->hasRole('football_group_staff') ||
                        auth()->user()->hasRole('partner'))
                    <li>
                        <a href="{{ route('other-football-job.index') }}"><i class="fas fa-user"></i>Other
                            Football Job</a>
                    </li>
                @else
                @endif

                @if (auth()->user()->hasRole('other_football_job') ||
                        auth()->user()->hasRole('football_group_staff') ||
                        auth()->user()->hasRole('partner') ||
                        auth()->user()->hasRole('registered_football_club'))
                    <li>
                        <a href="{{ route('football-club.index') }}"><i class="fas fa-user"></i>Football
                            Club</a>
                    </li>
                @else
                @endif

                @if (auth()->user()->hasexactroles('registered_football_club'))
                    <li>
                        <a href="{{ route('player.list') }}"><i class="fas fa-user"></i>Pick Players</a>
                    </li>
                @else
                @endif
                @if (auth()->user()->hasexactroles('registered_football_club'))
                    <li>
                        <a href="{{ route('manager.list') }}"><i class="fas fa-user"></i>Pick Manager</a>
                    </li>
                @else
                @endif


                <li style="display:{{ haveAllRoles_super_admin() ? '' : 'none' }}">
                    <a href="{{ route('all.players.with.clubs') }}"><i class="fas fa-user"></i>Selected Players
                        By Clubs</a>
                </li>

                <li style="display:{{ haveAllRoles_super_admin() ? '' : 'none' }}">
                    <a href="{{ route('all.managers.with.clubs') }}"><i class="fas fa-user"></i>Selected
                        Managers By Clubs</a>
                </li>





                {{-- <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-desktop"></i>UI Elements</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
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
        </div>
    </nav>
</header>