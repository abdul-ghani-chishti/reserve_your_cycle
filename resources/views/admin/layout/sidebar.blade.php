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
            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="nav.dash.main"><i
                            class="la la-user-plus"></i>Manage User</span></a>
                <ul class="menu-content">
                    <li><a href="" class="menu-item">Users</a>
                    </li>
                    <li><a href="{{route('admin.manage_user.pending_account')}}" class="menu-item">Pending Accounts</a>
                    </li>
                    <li><a href="" class="menu-item">Blocked Accounts</a>
                    </li>
                    <li><a class="menu-item">Add New Admin</a></li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="nav.dash.main"><i
                            class="la la-warning"></i>Notification</span></a>
                <ul class="menu-content">
                    <li><a href="" class="menu-item">Email</a>
                    </li>
                    <li><a href="" class="menu-item">Push Notification</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li>
                <a href="{{route('admin.live_chat')}}" class="menu-item">
                    <i class="la la-sticky-note"></i>Live Chat</a></li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li>
                <a href="" class="menu-item">
                    <i class="la la-sticky-note"></i>Report</a></li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li>
            <a class="menu-item">
                <i class="la la-comment"></i>About</a></li>
        </ul>
    </div>
</div>
