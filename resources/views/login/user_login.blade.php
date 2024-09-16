@extends('login.layout.master')

@section('title', 'Dashboard')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            @include('admin.inc.messages')
            <div class="content-body">
                <div class="card">
                    <div class="card-content text-center">
                        <div class="card-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="p-5 bg-gradient-directional-blue-grey">
                                        <h2 class="text-white mb-5">User Login</h2>
                                        <form>

                                            <div class="form-group">
                                                <h4 for="exampleInputEmail1" class="text-white">Email address</h4>
                                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                                <small id="emailHelp" class="form-text text-white">We'll never share your email with anyone else.</small>
                                            </div>
                                            <div class="form-group">
                                                <h4 for="exampleInputPassword1" class="text-white">Password</h4>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <div class="form-group form-check mt-5">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
