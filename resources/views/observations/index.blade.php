@extends('layouts.master')
@section('title', 'Observations')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endsection

@section('style')
<style>
    table.dataTable tbody td {
        vertical-align: middle;
    }

    table.dataTable td:nth-child(2) {
        max-width: 100px;
    }

    table.dataTable td:nth-child(3) {
        max-width: 170px;
    }

    table.dataTable td:nth-child(7) {
        max-width: 50px;
    }

    table.dataTable td {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

</style>
@endsection

@section('breadcrumb-title')
<h3>@yield('title')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                        <select id="Select_1" class="form-control input-sm select2" data-placeholder="Lecturer">
                            <option value="">Lecturer</option>
                            @foreach($lecturer as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="Select_2" class="form-control input-sm select2"
                            data-placeholder="Attendance Status">
                            <option value="">Attendance Status</option>
                            <option value=0>Not Yet</option>
                            <option value=1>Attend</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-end">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table table-hover table-sm" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" width="20px">No</th>
                                    <th scope="col">Lecturer</th>
                                    <th scope="col">Schedule</th>
                                    <th scope="col">Attendance</th>
                                    <th scope="col">Doc.</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col" width="65px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script>
    "use strict";
    setTimeout(function () {
        (function ($) {
            "use strict";
            $(".select2").select2({
                allowClear: true,
                minimumResultsForSearch: 7
            });
        })(jQuery);
    }, 350);

</script>
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            language: {
                searchPlaceholder: 'Search by remark..',
                sSearch: '_INPUT_ &nbsp;',
                lengthMenu: '<span>Show:</span> _MENU_',
            },
            ajax: {
                url: "{{ route('api.observations_by_auditor_id') }}",
                data: function (d) {
                    d.lecturer_id = $('#Select_1').val(),
                        d.attendance = $('#Select_2').val(),
                        d.search = $('input[type="search"]').val()
                },
            },
            columns: [{
                    render: function (data, type, row, meta) {
                        var no = (meta.row + meta.settings._iDisplayStart + 1);
                        return no;
                    },
                    orderable: false,
                    className: "text-center"
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "<span title='" + row.schedule.lecturer['name'] + "'>" + row
                            .schedule.lecturer['name'] + "</span>";
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = moment(row.schedule.date_start).format("DD-MMM-YY HH:mm") +
                            " to ";
                        if (moment(row.schedule.date_start).format("DD/MM/YY") == moment(row
                                .schedule.date_end).format("DD/MM/YY")) {
                            x += moment(row.schedule.date_end).format("HH:mm");
                        } else {
                            x += moment(row.schedule.date_end).format("DD-MMM-YY HH:mm");
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        if (row.attendance == true) {
                            x = '<span class="badge badge-' + row.color + '" title="attend">' +
                                moment(row.updated_at).format("DD-MMM-YY HH:mm") +
                                '</span>';
                        } else {
                            x = '<span class="badge badge-' + row.color + '">not yet</span>';
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        if (row.image_path != null) {
                            x =
                                '<a target="_blank" href="' + row.image_path +
                                '"><img class="float-start chat-user-img img-30" src="' +
                                row.image_path + '"></a>';
                        }
                        return x;
                    },
                },

                {
                    render: function (data, type, row, meta) {
                        return row.remark;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return `<a class="btn btn-info btn-sm px-2" href="{{ url('observations/` +
                            row.link + `') }}"><i class="fa fa-eye"></i></a>`;
                    },
                    orderable: false,
                    className: "text-end"
                }
            ]
        });
        $('#Select_1').change(function () {
            table.draw();
        });
        $('#Select_2').change(function () {
            table.draw();
        });
    });

</script>
@endsection
