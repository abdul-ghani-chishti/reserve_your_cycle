@extends('admin.layout.master')
@section('title', 'Pending Accounts')
@section('content')
    <h1>Pending Accounts</h1>
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
                                    <th class="border-primary border-darken-1">Documents</th>
                                    <th class="border-primary border-darken-1">Status</th>
                                    <th class="border-primary border-darken-1">Request Date</th>
                                    <th class="border-primary border-darken-1"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="documents_modal" tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="documentsModalLabel">User Documents</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Images will load here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Zoom Modal -->
        <div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content bg-dark border-0">
                    <div class="modal-body text-center p-0">
                        <img src="" alt="Zoomed Document" class="img-fluid rounded shadow-lg" style="max-height: 140vh; width: auto;">
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

    <style>
        .doc-thumb {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s;
        }
        .doc-thumb:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
    </style>
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
                scrollX: false,
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
                ajax: '{{ route('admin.manage_user.pending_account_list') }}',
                rowId: 'id',
                order: [[3, 'desc']],
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
                    {data: 'user_name', name: 'users.name', class: 'align-middle user_name'},
                    {data: 'user_email', name: 'users.email', class: 'align-middle email'},
                    {data: 'documents', name: 'documents', class: 'align-middle show_user_documents'},
                    {data: 'status', name: 'users.status', class: 'align-middle status'},
                    {data: 'request_date', name: 'users.created_at', class: 'align-middle request_date'},
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

                        if ($(header).is('.serial_number') || $(header).is('.action') || $(header).is('.matriculation')) {
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
                if ($(this).hasClass('reject')) {
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

            $('body').on('click', '#datatable tbody tr td.show_user_documents button', function () {
                var id = parseInt($(this).parents('tr').attr('id'));
                console.log('Fetching documents for user:', id);

                // Show loading message
                $('#documents_modal .modal-body').html('<p class="text-center text-muted">Loading documents...</p>');
                $('#documents_modal').modal('show');

                $.ajax({
                    url: '{!! route('admin.manage_user.pending_account_show_docs') !!}',
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'user_id': id
                    },
                    success: function (data) {
                        if (data && data.imgs && data.imgs.length > 0) {
                            var show_documents = '<div class="d-flex flex-wrap justify-content-start gap-3">';

                            $.each(data.imgs, function (index, img_path) {
                                var fullPath = '/' + img_path; // full image path
                                show_documents += `
                        <div class="text-center">
                            <img src="${fullPath}"
                                 alt="User Document ${index + 1}"
                                 class="img-thumbnail doc-thumb shadow-sm"
                                 style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;"
                                 data-full="${fullPath}">
                            <p class="mt-2 small text-muted">Document ${index + 1}</p>
                        </div>
                    `;
                            });

                            show_documents += '</div>';
                            $('#documents_modal .modal-body').html(show_documents);

                            // Zoom modal functionality
                            $('.doc-thumb').on('click', function () {
                                var fullImg = $(this).data('full');
                                $('#zoomModal img').attr('src', fullImg);
                                $('#zoomModal').modal('show');
                            });

                        } else {
                            $('#documents_modal .modal-body').html('<p class="text-center text-muted">No documents found for this user.</p>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error loading documents:', error);
                        $('#documents_modal .modal-body').html('<p class="text-danger text-center">Failed to load documents.</p>');
                    }
                });
            });

        });
    </script>
@endsection

