@extends('login.layout.master')

@section('title', 'Dashboard')

@section('content')

{{--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}
{{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>--}}
{{--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>--}}
<!------ Include the above in your HEAD tag ---------->

<style>
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
</style>

<div class="container">
    <div class="row mb-5 justify-content-center">
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
            <div class="card card-inverse card-info">
                <img class="card-img-top" src="https://picsum.photos/200/150/?random">
                <div class="card-block">
                    <figure class="profile">
                        <img src="https://picsum.photos/200/150/?random" class="profile-avatar" alt="">
                    </figure>
                    <h4 class="card-title mt-3">By-Cycle Owner</h4>
                    <div class="meta card-text">
                        <a>Admin</a>
                    </div>
                    <div class="card-text">
                        Tawshif is a web designer living in Bangladesh.
                    </div>
                </div>
                <div class="card-footer">
                    <small>Last updated 3 mins ago</small>
                    <a href="{{route('login.admin_login')}}"><button class="btn btn-info float-right btn-sm">Follow</button></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
            <div class="card card-inverse card-info">
                <img class="card-img-top" src="https://picsum.photos/200/150/?random">
                <div class="card-block">
                    <figure class="profile">
                        <img src="https://picsum.photos/200/150/?random" class="profile-avatar" alt="">
                    </figure>
                    <h4 class="card-title mt-3">Need A By-Cycle</h4>
                    <div class="meta card-text">
                        <a>User</a>
                    </div>
                    <div class="card-text">
                        Tawshif is a web designer living in Bangladesh.
                    </div>
                </div>
                <div class="card-footer">
                    <small>Last updated 3 mins ago</small>
                    <a href="{{route('login.user_login')}}"><button class="btn btn-info float-right btn-sm">Follow</button></a>
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
