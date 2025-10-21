<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark bg-primary navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a href="{{route('dashboard.index')}}" class="navbar-brand">
                        <h1 style="color: white">Cycle Reservation Portal</h1>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              id="sidebar_menu" href="#"><i class="ft-menu"></i></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="nav-link d-inline-flex align-middle p-0">
                            <div class="m-0 bg-white primary rounded custom-nav-buttons-padding">
                                <span
                                    class="d-inline-block d-md-none d-lg-none d-xl-inline-block align-middle font-weight-bold">
                                    Welcome {{auth()->user()->name}}
                                </span>
                            </div>
                        </a>
                        <a class="nav-link d-inline-flex align-middle p-0">
                            <div class="m-0 bg-white warning rounded custom-nav-buttons-padding">
                                <span
                                    class="d-inline-block d-md-none d-lg-none d-xl-inline-block align-middle font-weight-bold">
                                    Status: {{Auth::user()->status->name}}
                                </span>
                            </div>
                        </a>
                        <a class=" nav-link d-inline-flex align-middle p-0" id="logout" target="_blank">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="m-0 bg-white primary rounded custom-nav-buttons-padding" type="submit">
                                    Logout
                                </button>
                            </form>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@section('js')
    <script type="text/javascript">

    </script>
