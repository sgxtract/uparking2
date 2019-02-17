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
                            <small class="designation text-muted">{{ Auth::user()->name . ' ' . Auth::user()->last_name }}</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->staff || Auth::user()->admin)
                    <button class="btn btn-success btn-block" onclick="location.href = '{{ route('reserveSlot') }}';">Reserve
                        <i class="mdi mdi-plus"></i>
                    </button>
                @endif
            </div>
        </li>

        @if(Auth::user()->staff == false || Auth::user()->admin == true)

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

        @if(Auth::user()->staff == true)

        <li class="nav-item">
            <a class="nav-link">Staff</a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'staffDashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffDashboard') }}">
                <i class="menu-icon mdi mdi-speedometer"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item" {{ Route::currentRouteName() == 'staffCheckIn' ? 'active' : '' }}>
            <a class="nav-link" href="{{ route('staffCheckIn') }}">
                <i class="menu-icon mdi mdi-arrow-right-thick"></i>
                <span class="menu-title">Check In</span>
            </a>
        </li>

        <li class="nav-item" {{ Route::currentRouteName() == 'staffCheckOut' ? 'active' : '' }}>
            <a class="nav-link" href="{{ route('staffCheckOut') }}">
                <i class="menu-icon mdi mdi-arrow-left-thick"></i>
                <span class="menu-title">Check Out</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'staffHistory' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staffHistory') }}">
                <i class="menu-icon mdi mdi-calendar-clock"></i>
                <span class="menu-title">History</span>
            </a>
        </li>

        @endif

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

        <li class="nav-item {{ Route::currentRouteName() == 'adminHistory' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('adminHistory') }}">
                <i class="menu-icon mdi mdi-calendar-clock"></i>
                <span class="menu-title">History</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'adminUsers' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('adminUsers') }}">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>

        @endif
    </ul>
</nav>
<!-- partial -->
