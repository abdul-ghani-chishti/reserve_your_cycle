<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark bg-primary navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand">
<h1 style="color: white">ALFARRAID</h1>
                        {{--                        <img class="brand-logo sonic" alt="Sonic" src="{{ asset('img/sonic_logo_white_new.png') }}">--}}
{{--                        <img class="brand-logo trax" alt="Trax" src="{{ asset('img/trax_logo_white_new.png') }}">--}}
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" id="sidebar_menu" href="#"><i class="ft-menu"></i></a></li>
                   {{-- <li class="nav-item d-none d-md-flex justify-content-center h4 m-auto"><p class="m-auto white"><span class="d-none d-lg-inline-block">For Assistance Call:</span> <a href="tel:+922138772222" target="_blank" class="text-bold-700 white">021-111-118-729</a></p></li>--}}
{{--                    <a class="nav-link d-inline-flex align-middle p-1" href="{{ route('admin.attendance.mark') }}" target="_blank">--}}
{{--                        <div class="m-0 bg-white primary rounded custom-nav-buttons-padding">--}}
{{--                            <span class="d-inline-block d-md-none d-lg-none d-xl-inline-block align-middle font-weight-bold">Attendance</span>--}}
{{--                            <h2 class="d-inline-block m-0 align-middle primary"><i class="la la-calendar m-0"></i></h2>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    @if (session('role_id') == 1)--}}
{{--                        <a class="nav-link d-inline-flex align-middle p-1" href="{{ route('admin.settings.bolt_update_version.index') }}" target="_blank">--}}
{{--                            <div class="m-0 bg-white primary rounded custom-nav-buttons-padding">--}}
{{--                                <span class="d-inline-block d-md-none d-lg-none d-xl-inline-block align-middle font-weight-bold">Bolt Version Update</span>--}}
{{--                                <h2 class="d-inline-block m-0 align-middle primary"><i class="la la-cogs m-0"></i></h2>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @endif--}}
                </ul>

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="nav-link d-inline-flex align-middle p-0"  target="_blank">
                            <div class="m-0 bg-white primary rounded custom-nav-buttons-padding">
                                <span class="d-inline-block d-md-none d-lg-none d-xl-inline-block align-middle font-weight-bold">Tracking</span>
                                <h2 class="d-inline-block m-0 align-middle primary"><i class="la la-crosshairs m-0"></i></h2>
                            </div>
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
