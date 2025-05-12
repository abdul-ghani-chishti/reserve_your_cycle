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

    .card_border{
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
                            @if(session('user_type') == 1)
                                <div class="content-body">
                                    <div class="card">
                                        <div class="card-content text-center">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="home_quicklink">
                                                            <a class="quicklink link1 rent_your_cycle" href="#">
                                                                <span class="ql_caption">
                                                                    <span class="outer">
                                                                        <span class="inner">
                                                                            <h2>Rent your Cycle</h2>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                                <span class="ql_top"></span>
                                                                <span class="ql_bottom"></span>
                                                            </a>
                                                            <a class="quicklink link3" href="#">
                                                                <span class="ql_caption">
                                                                    <span class="outer">
                                                                        <span class="inner">
                                                                            <h2>Deactivate </h2>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                                <span class="ql_top"></span>
                                                                <span class="ql_bottom"></span>
                                                            </a>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(session('user_type') == 0)
                                <h1 class="">You're logged in as not having a cycle!</h1>
                                    <div class="container">
                                        <div class="row">
                                            @foreach($cycle_infos as $cycle_info)
                                                <a href="{{ route('cycle_info.show_cycle_details', ['id' => $cycle_info['id']]) }}" class="text-decoration-none text-dark">
                                                <div class="col-sm-6 col-md-4 col-lg-3 mt-4 card_border justify-content-start">
                                                    <div class="card mt-2">
                                                        <img class="card-img-top" src="https://picsum.photos/200/150/?random
">
                                                        <div class="card-block">
                                                            <p class="">Brand Name: {{$cycle_info['brand']}}</p>
                                                            <p class="">Model: {{$cycle_info['model']}}</p>
                                                            <p class="">Type: {{$cycle_info['type']}}</p>
                                                            <div class="meta">
                                                                <a href="#">Friends</a>
                                                            </div>
                                                            <div class="card-text">
                                                                Description: {{$cycle_info['description']}}
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <span class="float-right">Available Date: {{$cycle_info['brand']}}</span>
{{--                                                            <span><i class=""></i>75 Friends</span>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_cycle_modal_form" data-backdrop="static" role="dialog"
         aria-labelledby="add_cycle_modal_form" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if($cycle_available)
                    <h4 class="modal-title" id="delivered_shipments_modal_title">Add Cycle Details | Already Have an Active Cycle</h4>
                    @endif
                        <h4 class="modal-title" id="delivered_shipments_modal_title">Add Cycle Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form id="add_cycle_modal_form" action="{{route('cycle_info.add_cycle_modal_form')}}" method="post" enctype="multipart/form-data" class="form-horizontal mb-1 justify-content-center"
                          novalidate="novalidate">
                            {{ csrf_field() }}
                         <div class="row justify-content-center">
                            <div class="form-group col-5">
                                <input type="text" name="cycle_brand_name" id="cycle_brand_name" class="form-control cycle_brand_name"
                                       placeholder="Cycle Brand Name">
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="cycle_type" id="cycle_type" class="form-control cycle_type"
                                       placeholder="Cycle Type">
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="cycle_model" id="cycle_model" class="form-control cycle_model"
                                       placeholder="Cycle Model">
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="cycle_sku" id="cycle_sku" class="form-control cycle_sku"
                                       placeholder="Enter SKU">
                            </div>
                            <div class="form-group col-md-10">
                                <textarea type="text" name="cycle_description" id="cycle_description" class="form-control cycle_description"
                                          placeholder="Cycle Description"></textarea>
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="cycle_available_from" id="cycle_available_from" class="form-control cycle_available_from"
                                       placeholder="Cycle Available From">
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="cycle_available_to" id="cycle_available_to" class="form-control cycle_available_to"
                                       placeholder="Cycle Available To">
                            </div>
                            <div class="form-group col-5">
                                <input type="file" name="cycle_images[]" id="cycle_images" class="form-control cycle_images"
                                       placeholder="Select Images" multiple>
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="cycle_available_date" id="cycle_available_date" class="form-control cycle_available_date"
                                       placeholder="Cycle Available Date">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="">Confirm
                            </button>
                        </div>
                    </form>
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
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">

@endsection

@section('js')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.time.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var booking_from_date = $('#cycle_available_date').pickadate({
                firstDay: 1,
                clear: '',
                min: true,
                {{--max: '{{ Carbon\Carbon::now() }}',--}}
                format: 'dd mmmm, yyyy',
                selectYears: true,
                selectMonths: true,
                formatSubmit: 'yyyy-mm-dd 00:00:00',
                hiddenSuffix: '_formatted',
            });
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 7);
            $('#cycle_available_date').pickadate('picker').set('max', maxDate);

            var available_from_time = $('#cycle_available_from').pickatime({
                format: 'HH:00', // 24-hour format with only hours
                interval: 60, // Only allow selecting hours (no minutes)
                min: [0, 0], // Start at 00:00
                max: [23, 0], // End at 23:00
                clear: '', // Removes the "Clear" button

                onSet: function (context) {
                    if (context.select) {
                        // console.log('selected');
                        // document.getElementById("cycle_available_from").disabled = true;
                    }
                }
            }).pickatime('picker');

            var available_to_time = $('#cycle_available_to').pickatime({
                format: 'HH:00', // 24-hour format with only hours
                interval: 60, // Only allow selecting hours (no minutes)
                min: [0, 0], // Start at 00:00
                max: [23, 0], // End at 23:00
                clear: '', // Removes the "Clear" button
            }).pickatime('picker');

            $('#cycle_available_to').click(function() {
                var selectedTime = available_from_time.get('select'); // Get selected time from available_from_time

                if (selectedTime) {
                    var selectedHour = selectedTime.hour; // Extract hour
                    available_to_time.set('min', [selectedHour, 0]); // Set new min value
                }
            });

            $('body').on('click','.rent_your_cycle',function () {
                $('#add_cycle_modal_form').modal('show');
            });

            $('#add_cycle_modal_form form').validate({
                errorClass: 'danger',
                successClass: 'success',
                errorPlacement: function(error, element) {
                    error.addClass('w-100').appendTo(element.parent('.form-group'));
                },
                submitHandler: function(form) {
                    swal({
                        text: 'Are you sure, about the dates and hours ?',
                        icon: 'info',
                        buttons: {
                            cancel: {
                                text: 'No',
                                value: null,
                                visible: true,
                                closeModal: true,
                            },
                            confirm: {
                                text: 'Yes',
                                value: true,
                                visible: true,
                                closeModal: true
                            }
                        },
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        dangerMode: true
                    }).then(function(confirm) {
                        console.log('Form Hit');
                        if(confirm){
                            console.log('form',form)
                            $(form).find('button[type=submit]').attr('disabled', 'disabled');
                            form.submit();
                        }
                        $(form).find('button[type=submit]').attr('disabled', false);
                    });
                }
            });

            let cycle_available = '{{$cycle_available}}'
            console.log(cycle_available);
            if (cycle_available == 1)
            {
                console.log('exist')
                document.getElementById('cycle_brand_name').readOnly = true;
                document.getElementById('cycle_type').readOnly = true;
                document.getElementById('cycle_model').readOnly = true;
                document.getElementById('cycle_sku').readOnly = true;
                document.getElementById('cycle_description').readOnly = true;
                document.getElementById('cycle_images').disabled = true;
                document.getElementById('cycle_available_from').readOnly = false;
                document.getElementById('cycle_available_to').readOnly = false;
                document.getElementById('cycle_available_date').readOnly = false;

                function input_click(e)
                {
                    e.stopPropagation();
                    return false;
                }
            }
            else
            {
                console.log('not_exist')
                document.getElementById('cycle_available_from').readOnly = false;
                document.getElementById('cycle_available_to').readOnly = false;
                document.getElementById('cycle_available_date').readOnly = false;
            }
        });
    </script>
@endsection
