@extends('user.layout.master')
@section('title', 'Dashboard')
@section('content')
    <h1>Reservation History </h1>
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered datatable" id="datatable"
                               style="z-index: 3;">
                            <thead>
                            <tr class="bg-primary white">
                                <th class="border-primary border-darken-1">S No.</th>
                                <th class="border-primary border-darken-1">User Name</th>
                                <th class="border-primary border-darken-1">Email</th>
                                <th class="border-primary border-darken-1">Cycle Status</th>
                                <th class="border-primary border-darken-1">Cycle Available Date</th>
                                <th class="border-primary border-darken-1">Cycle Available Hours</th>
                                <th class="border-primary border-darken-1"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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

    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#datatable').DataTable({
                dom: '<"d-inline-block"l><"pull-right"B>tipr',
                buttons: [
                    {
                    text: 'Feature Button',
                    className: 'btn btn-primary',
                    enabled: true,
                    action: function (e, dt, node, config) {
                        $('#add_route').modal('show');}},
                    ],
                scrollX: true,
                // scrollY: '500px',
                "autoWidth": false,
                // lengthMenu: [[50, 100, 500, 1000, -1], [50, 100, 500, 1000, 'All']],
                lengthMenu: [[10, 50 ,100, 500, 1000, -1], [10, 50, 100, 500, 1000, 'All']],
                pageLength: 10,
                pagingType: 'full_numbers',
                processing: true,
                language: {
                    processing: data_table_loader
                },
                serverSide: true,
                ajax: '{{ route('booking.admin_cycle_reservation_list') }}',
                rowId: 'id',
                order: [[4, 'desc']],
                columns: [
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        name: 'align-middle serial_number',
                        class: 'align-middle serial_number',
                        targets: 0,
                        render: function (data, type, row) {
                            return '';
                        }
                    },
                    {data: 'name', name: 'u.name', class: 'align-middle name'},
                    {data: 'email', name: 'u.email', class: 'align-middle email'},
                    {data: 'status_name', name: 'cas.name', class: 'align-middle status_name'},
                    {data: 'available_date', name: 'ca.available_date', class: 'align-middle available_date'},
                    {data: 'available_hours', name: 'ca.available_hours', class: 'align-middle available_hours'},
                    {data: 'action', name: 'action', class: 'align-middle action text-center', orderable: false, searchable: false}
                ],
                rowCallback: function (row, data, index) {
                    var info = table.page.info();

                    $('td:eq(0)', row).html(index + 1 + info.page * info.length);

                },
                initComplete: function () {
                    var search = $('<tr role="row" class="bg-primary bg-lighten-1 search"></tr>').appendTo(this.api().table().header());

                    var td = '<td style="padding:5px;" class="border-primary border-lighten-2"><fieldset class="form-group m-0 position-relative has-icon-right"></fieldset></td>';
                    var input = '<input type="text" class="form-control form-control-sm input-sm primary">';
                    var icon = '<div class="form-control-position primary"><i class="la la-search"></i></div>';

                    this.api().columns().every(function (column_id) {
                        var column = this;
                        var header = column.header();

                        if ($(header).is('.serial_number') || $(header).is('.action')) {
                            $(td).appendTo($(search));
                        } else {
                            var current = $(input).appendTo($(search)).on('change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            }).wrap(td).after(icon);

                            if (column.search()) {
                                current.val(column.search());
                            }
                        }
                    });

                    this.api().table().columns.adjust();
                }
            });

            $('#datatable tbody').on('click', 'tr td.action .btn-group .dropdown-menu .dropdown-item', function() {
                if ($(this).hasClass('cancel_booking')) {
                    var cycle_availability_id = $(this).data('target-id')

                    $.ajax({
                        url: '{!! route('booking.cancel_booking') !!}',
                        method: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'cycle_availability_id': cycle_availability_id
                        }
                    }).done(function(data){
                        if(data.status == 1){
                            scan_sound(1)
                            toastr.success(data.success, 'Success!', {positionClass: 'toast-bottom-center', containerId: 'toast-bottom-center'});
                        }
                        else{
                            scan_sound(0)
                            toastr.error(data.error, 'Error!', {positionClass: 'toast-top-center', containerId: 'toast-top-center'});
                        }
                        table.draw()
                    });
                }
            });
        });
    </script>
@endsection
