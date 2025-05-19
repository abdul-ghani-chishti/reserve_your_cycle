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
                    <a href="" class="menu-item">
                        <i class="la la-user-plus"></i>Reservations</a>
                </li>
            @else
                <li>
                    <a href="{{route('booking.user_reservation')}}" class="menu-item">
                        <i class="la la-user-plus"></i>My Reservations</a>
                </li>
            @endif
            <li>
                <a href="" class="menu-item">
                    <i class="la la-user-plus"></i>Notifications</a></li>
        </ul>
{{--        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">--}}
{{--            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="nav.dash.main"><i--}}
{{--                            class="la la-cart-plus"></i>Shariat</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li><a href="" class="menu-item">Quran</a>--}}
{{--                    </li>--}}
{{--                    <li><a class="menu-item">Hadith--}}
{{--                            Book</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">--}}
{{--            <li class="nav-item"><a href="#"><span class="menu-title" data-i18n="nav.dash.main">--}}
{{--                        <i class="la la-cart-plus"></i>Heirs</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li><a class="menu-item">Ashabulfarooz</a></li>--}}
{{--                    <li><a class="menu-item">Asbats</a></li>--}}
{{--                    <li><a class="menu-item">Zulahram</a></li>--}}
{{--                    <li><a class="menu-item">Types of heirs</a></li>--}}
{{--                    <li><a class="menu-item">Share</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">--}}
{{--            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="nav.dash.main">--}}
{{--                        <i class="la la-cart-plus"></i>Information</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li><a class="menu-item">History</a>--}}
{{--                    </li>--}}
{{--                    <li><a class="menu-item">Limitation</a></li>--}}
{{--                    <li><a class="menu-item">Eligibility</a></li>--}}

{{--                    <li><a class="menu-item">Hijab Harmain</a></li>--}}

{{--                    <li><a class="menu-item">Defination</a></li>--}}
{{--                    <li><a class="menu-item">Charts</a>--}}
{{--                        <ul class="menu-content">--}}
{{--                            <li><a class="menu-item">Azbats Chart</a>--}}
{{--                            </li>--}}
{{--                            <li><a class="menu-item">ZulArhams Chart</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">--}}
{{--            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="nav.dash.main">--}}
{{--                        <i class="la la-cart-plus"></i>Methodology</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li><a class="menu-item">Assets</a>--}}
{{--                    </li>--}}
{{--                    <li><a class="menu-item">Debits</a></li>--}}
{{--                    <li><a class="menu-item">Funeral Expenditures</a></li>--}}

{{--                    <li><a class="menu-item">Will</a></li>--}}
{{--                    <li><a class="menu-item">Performa</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li>
            <a class="menu-item">
                <i class="la la-user-plus"></i>About</a></li>
        </ul>
    </div>
</div>
