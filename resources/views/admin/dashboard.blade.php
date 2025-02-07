@extends('admin.layout.master')

@section('title', 'Dashboard')

@section('content')
    <style>
        #home_quicklinks {
            padding: 20px 0;
            text-align: center;
        }

        a.quicklink.link1 {
            background: #fc6719;
        }

        a.quicklink {
            display: inline-block;
            width: 302px;
            height: 173px;
            position: relative;
            margin: 90px 30px;
        }

        a.quicklink .ql_caption {
            display: block;
            height: 100%;
            width: 100%;
            position: relative;
        }

        .outer {
            display: table;
            position: relative;
            vertical-align: middle;
            text-align: center;
            height: 100%;
            width: 100%;
            border-spacing: 0px;
            padding: 0px;
        }

        .inner {
            display: table-cell;
            position: relative;
            vertical-align: middle;
            text-align: center;
            height: 100%;
            width: 100%;
            border-spacing: 0px;
            padding: 0px;
        }

        a.quicklink .ql_caption h2 {
            margin: 0px;
            padding: 0px;
            text-transform: uppercase;
            line-height: 1.46em;
            color: #fff;
        }

        a.quicklink.link1 .ql_top {
            border-bottom-color: #fc6719;
        }

        a.quicklink.link1 .ql_bottom {
            border-top-color: #fc6719;
        }


        .ql_top {
            bottom: 173px;
            border-bottom: 89px solid #ccc;
        }

        .ql_bottom {
            top: 173px;
            border-top: 89px solid #ccc;
        }

        .ql_top, .ql_bottom {
            position: absolute;
            left: 0px;
            width: 0px;
            border-left: 151px solid transparent;
            border-right: 151px solid transparent;
        }

        a.quicklink.link2 {
            background: #fcf4e7;
        }

        a.quicklink.link2 .ql_top {
            border-bottom-color: #fcf4e7;
        }

        a.quicklink.link2 .ql_bottom {
            border-top-color: #fcf4e7;
        }


        a.quicklink.link3 .ql_top {
            border-bottom-color: #bcbdc0;
        }

        a.quicklink.link3 .ql_bottom {
            border-top-color: #bcbdc0;
        }

        a.quicklink.link3 {
            background: #bcbdc0;
        }

        a.quicklink {
            font-size: 36px;
            font-weight: 500;
            text-decoration: none;
        }

        .hexagon {
            position: relative;
            width: 300px;
            height: 173.21px;
            margin: 86.60px 0;
            background-image: url(http://csshexagon.com/img/meow.jpg);
            background-size: auto 334.8632px;
            background-position: center;
            box-shadow: 0 0 20px rgba(0, 128, 192, 0.6);
            border-left: solid 5px #4a401c;
            border-right: solid 5px #4a401c;
        }

        .hexTop,
        .hexBottom {
            position: absolute;
            z-index: 1;
            width: 212.13px;
            height: 212.13px;
            overflow: hidden;
            -webkit-transform: scaleY(0.5774) rotate(-45deg);
            -ms-transform: scaleY(0.5774) rotate(-45deg);
            transform: scaleY(0.5774) rotate(-45deg);
            background: inherit;
            left: 38.93px;
            box-shadow: 0 0 20px rgba(0, 128, 192, 0.6);
        }

        /*counter transform the bg image on the caps*/
        .hexTop:after,
        .hexBottom:after {
            content: "";
            position: absolute;
            width: 290.0000px;
            height: 167.4315780649915px;
            -webkit-transform: rotate(45deg) scaleY(1.7321) translateY(-83.7158px);
            -ms-transform: rotate(45deg) scaleY(1.7321) translateY(-83.7158px);
            transform: rotate(45deg) scaleY(1.7321) translateY(-83.7158px);
            -webkit-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            transform-origin: 0 0;
            background: inherit;
        }

        .hexTop {
            top: -106.0660px;
            border-top: solid 7.0711px #4a401c;
            border-right: solid 7.0711px #4a401c;
        }

        .hexTop:after {
            background-position: center top;
        }

        .hexBottom {
            bottom: -106.0660px;
            border-bottom: solid 7.0711px #4a401c;
            border-left: solid 7.0711px #4a401c;
        }

        .hexBottom:after {
            background-position: center bottom;
        }

        .hexagon:after {
            content: "";
            position: absolute;
            top: 2.8868px;
            left: 0;
            width: 290.0000px;
            height: 167.4316px;
            z-index: 2;
            background: inherit;
        }
    </style>
    <div class="app-content content">
        <div class="content-wrapper">
            @include('admin.inc.messages')
            <div class="content-body">
                <div class="card">
                    <div class="card-content text-center">
                        <div class="card-body">
                            <h1 class="mb-5">Welcome Super Admin ...</h1>
                            <div class="container">
                                <div class="row justify-content-center">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">

@endsection

@section('js')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection

{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Admin Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900">--}}
{{--                    <h4>Admin Dashboard</h4>--}}
{{--                    <form method="POST" action="{{ route('admin.logout') }}">--}}
{{--                        @csrf--}}

{{--                        <x-responsive-nav-link :href="route('logout')"--}}
{{--                                               onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                            {{ __('Log Out') }}--}}
{{--                        </x-responsive-nav-link>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}
