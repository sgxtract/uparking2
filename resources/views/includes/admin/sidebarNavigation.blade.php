<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ asset('admin/assets/images/faces/ninjaface.png') }}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::user()->name . ' ' . Auth::user()->last_name }}</p>
                        <div>
                            <small class="designation text-muted">
                                @if (Auth::user()->admin)
                                Administrator
                                @endif
                                @if (!Auth::user()->admin && Auth::user()->staff)
                                Staff
                                @endif
                                @if (!Auth::user()->admin && !Auth::user()->staff)
                                Online
                                @endif
                            </small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->admin)
                <button class="btn btn-success btn-block" onclick="location.href = '{{ route('adminReserve') }}';">Reserve
                    <i class="mdi mdi-plus"></i>
                </button>
                @elseif(Auth::user()->staff)
                <button class="btn btn-success btn-block" onclick="location.href = '{{ route('staffReserve') }}';">Reserve
                    <i class="mdi mdi-plus"></i>
                </button>
                @else
                <button class="btn btn-success btn-block" onclick="location.href = '{{ route('userReserve') }}';">Reserve
                    <i class="mdi mdi-plus"></i>
                </button>
                @endif
            </div>
        </li>

        {{-- Admin Sidebar --}}

        @if(Auth::user()->admin == true)

        <li class="nav-item">
            <a class="nav-link">Administrator</a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'adminDashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('adminDashboard') }}">
                <i class="menu-icon mdi mdi-speedometer"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'adminVehicles' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('adminVehicles') }}">
                <i class="menu-icon mdi mdi-car"></i>
                <span class="menu-title">Vehicle</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#history" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-calendar-clock"></i>
                <span class="menu-title">History</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="history">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminUserLogs') }}">User Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminStaffLogs') }}">Staff Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminParkingLogs') }}">Parking Logs</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-content-copy"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminSalesReport') }}">Sales Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminStatisticsReport') }}">Statistics Report</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item {{ Route::currentRouteName() == 'adminUsers' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('adminUsers') }}">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>

        @endif

        {{-- Staff Sidebar --}}

        @if(Auth::user()->staff == true)

        @if(Auth::user()->admin == false)

        <li class="nav-item">
            <a class="nav-link">Staff</a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'staffDashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffDashboard') }}">
                <i class="menu-icon mdi mdi-speedometer"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @endif

        <li class="nav-item {{ Route::currentRouteName() == 'staffReservesView' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffReservesView') }}">
                <i class="menu-icon mdi mdi-parking"></i>
                <span class="menu-title">Reserves</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'staffAddFunds' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffAddFunds') }}">
                <i class="menu-icon mdi mdi-credit-card-plus"></i>
                <span class="menu-title">Add Funds</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'staffWalkIn' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffWalkIn') }}">
                <i class="menu-icon mdi mdi-walk"></i>
                <span class="menu-title">Walk-In</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'staffCheckIn' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffCheckIn') }}">
                <i class="menu-icon mdi mdi-arrow-right-thick"></i>
                <span class="menu-title">Check In</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'staffCheckOut' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffCheckOut') }}">
                <i class="menu-icon mdi mdi-arrow-left-thick"></i>
                <span class="menu-title">Check Out</span>
            </a>
        </li>

        {{-- <li class="nav-item {{ Route::currentRouteName() == 'staffHistory' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffHistory') }}">
                <i class="menu-icon mdi mdi-calendar-clock"></i>
                <span class="menu-title">History</span>
            </a>
        </li> --}}

        @endif

        {{-- User Sidebar --}}

        @if(Auth::user()->staff == false && Auth::user()->admin == false)

        <li class="nav-item">
            <a class="nav-link">User</a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'userDashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('userDashboard') }}">
                <i class="menu-icon mdi mdi-speedometer"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'userVehicle' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('userVehicle') }}">
                <i class="menu-icon mdi mdi-car"></i>
                <span class="menu-title">Vehicle</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'userBalance' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('userBalance') }}">
                <i class="menu-icon mdi mdi-wallet"></i>
                <span class="menu-title">Load Wallet</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'userHistory' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('userHistory') }}">
                <i class="menu-icon mdi mdi-calendar-clock"></i>
                <span class="menu-title">History</span>
            </a>
        </li>

        @endif

        @if (Auth::user()->admin == true)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cms" aria-expanded="false" aria-controls="cms">
                <i class="menu-icon mdi mdi-page-layout-body"></i>
                <span class="menu-title">Content Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="cms">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.homeCMS') }}">Edit Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.aboutCMS') }}">Edit About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.contactCMS') }}">Edit Contact</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</nav>
<!-- partial -->
