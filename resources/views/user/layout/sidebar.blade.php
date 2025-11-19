<div class="main-menu menu-fixed menu-light menu-accordion menu-bordered menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="">
                    <i class="la la-area-chart"></i><span
                        class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if(session('user_type') == 1)
                <li>
                    <a href="{{route('booking.cycle_reservation')}}" class="menu-item"> {{--cycle owner list--}}
                        <i class="la la-user-plus"></i>Reservations</a>
                </li>
            @else
                <li>
                    <a href="{{route('booking.user_reservation')}}" class="menu-item">
                        <i class="la la-user-plus"></i>My Reservations </a>
                </li>
            @endif
            <li>
                <a href="{{route('email_notification.email')}}" class="menu-item">
                    <i class="la la-user-plus" ></i>Notifications <span style="font-size: 0.8em; color: blue;">(Feature)</span>
                </a>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li>
            <a href="{{route('dashboard.about')}}" class="menu-item">
                <i class="la la-user-plus"></i>About</a></li>
        </ul>
    </div>
</div>
