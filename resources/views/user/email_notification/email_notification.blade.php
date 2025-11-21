@extends('user.layout.master')
@section('title', 'Email Notification')

@section('content')

    <h1 class="mb-2">Email Notification</h1>

    <section>
        <div class="row justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">
                            <i class="la la-envelope"></i> Send Email to Admin
                        </h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">

                            <form id="email_notification_form" method="post" action="{{route('email_notification.email_send')}}"
                                  enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="email_user" class="font-weight-bold">Send To</label>
                                    <input type="email" id="email_user" name="email_user"
                                           class="form-control"
                                           placeholder="Enter recipient email" value="chishtiabdulghani@gmail.com" required>
                                </div>

                                <div class="form-group">
                                    <label for="email_subject" class="font-weight-bold">Subject</label>
                                    <input type="text" id="email_subject" name="email_subject"
                                           class="form-control"
                                           placeholder="Enter subject" value="booking cycle" required>
                                </div>

                                <div class="form-group">
                                    <label for="email_message" class="font-weight-bold">Message</label>
                                    <textarea id="email_message" name="email_message"
                                              class="form-control" rows="5"
                                              placeholder="Write your email message here..."  required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Select Notification Date</label>
                                    <input type="text" id="noti_date" name="noti_date"
                                           class="form-control pickadate" placeholder="Pick a date">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Select Notification Time</label>
                                    <input type="text" id="noti_time" name="noti_time"
                                           class="form-control pickatime" placeholder="Pick a time">
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mt-2">
                                    <i class="la la-paper-plane"></i> Send Notification
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"

            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.time.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Submit form
            $('#email_notification_form').validate({
                errorClass: 'danger',
                successClass: 'success',
                errorPlacement: function (error, element) {
                    error.addClass('w-100').appendTo(element.parent('.form-group'));
                },
                submitHandler: function (form) {
                    swal({
                        text: 'Are you sure you want to send an email ?',
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
                    }).then(function (confirm) {
                        console.log('Form Hit');
                        if (confirm) {
                            console.log('form', form)
                            $(form).find('button[type=submit]').attr('disabled', 'disabled');
                            form.submit();
                        }
                        $(form).find('button[type=submit]').attr('disabled', false);
                    });
                }
            });
        });
    </script>
@endsection
