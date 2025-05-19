@extends('user.layout.master')

@section('title', 'Dashboard')
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

    /*    card box*/
    html {
        font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
        font-size: 14px;
    }

    h5 {
        font-size: 1.28571429em;
        font-weight: 700;
        line-height: 1.2857em;
        margin: 0;
    }

    .card {
        font-size: 1em;
        overflow: hidden;
        padding: 0;
        border: none;
        border-radius: .28571429rem;
        box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    }

    .card-block {
        font-size: 1em;
        position: relative;
        margin: 0;
        padding: 1em;
        border: none;
        border-top: 1px solid rgba(34, 36, 38, .1);
        box-shadow: none;
    }

    .card-img-top {
        display: block;
        width: 100%;
        height: auto;
    }

    .card-title {
        font-size: 1.28571429em;
        font-weight: 700;
        line-height: 1.2857em;
    }

    .card-text {
        clear: both;
        margin-top: .5em;
        color: rgba(0, 0, 0, .68);
    }

    .card-footer {
        font-size: 1em;
        position: static;
        top: 0;
        left: 0;
        max-width: 100%;
        padding: .75em 1em;
        color: rgba(0, 0, 0, .4);
        border-top: 1px solid rgba(0, 0, 0, .05) !important;
        background: #fff;
    }

    .card-inverse .btn {
        border: 1px solid rgba(0, 0, 0, .05);
    }

    .profile {
        position: absolute;
        top: -12px;
        display: inline-block;
        overflow: hidden;
        box-sizing: border-box;
        width: 25px;
        height: 25px;
        margin: 0;
        border: 1px solid #fff;
        border-radius: 50%;
    }

    .profile-avatar {
        display: block;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .profile-inline {
        position: relative;
        top: 0;
        display: inline-block;
    }

    .profile-inline ~ .card-title {
        display: inline-block;
        margin-left: 4px;
        vertical-align: top;
    }

    .text-bold {
        font-weight: 700;
    }

    .meta {
        font-size: 1em;
        color: rgba(0, 0, 0, .4);
    }

    .meta a {
        text-decoration: none;
        color: rgba(0, 0, 0, .4);
    }

    .meta a:hover {
        color: rgba(0, 0, 0, .87);
    }

    .card_border {
        border: 3px solid #007bff; /* Change color here */
        border-radius: 10px; /* Optional: Rounds the corners */
        margin: 25px;
    }
</style>

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('admin.inc.messages')
            <div class="content-body">
                <div class="card">
                    <div class="card-content text-center">
                        <div class="card-body">
                            <h1 class="mb-5">You Are Viewing Available Hours For : {{$available_date}}</h1>
                            <form id="reserve_available_hours_form"
                                  action="{{route('cycle_info.reserve_available_hours_form')}}"
                                  method="post" class="form-horizontal mb-1 justify-content-center"
                                  novalidate="novalidate">
                                {{ csrf_field() }}
                                <input name="available_date" value="{{$available_date}}" class="display-hidden">
                                <div class="form-group">
                                    <label class="text-bold" for="radios">Available Hours</label>
                                    <div class="">
                                        <div class="radio">
                                            @foreach($available_hours as $available_hour)
                                                <label for="radios-0">
                                                    <input type="checkbox" name="reserve_available_hours_ids[]"
                                                           id="reserve_available_hours_id"
                                                           value={{$available_hour['id']}}>
                                                    {{$available_hour['available_hours']}}
                                                </label>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <button type="submit" id="reserve_available_hours" class="btn btn-primary">
                                            Reserve
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">

@endsection

@section('js')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.time.js"></script>
@endsection
