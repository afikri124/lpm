@extends('layouts.master')
@section('title', 'Follow Up')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
<style>
    table.dataTable tbody td {
        vertical-align: middle;
    }

    table.dataTable td:nth-child(2) {
        max-width: 120px;
    }

    table.dataTable td:nth-child(3) {
        max-width: 100px;
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
<!-- <li class="breadcrumb-item"></li> -->
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
                        <select id="Select_2" class="form-control input-sm select2" data-placeholder="Attendance Status">
                            <option value="">Attendance Status</option>
                            <option value=2>Not Yet</option>
                            <option value=1>Done</option>
                        </select>
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
                                    <th scope="col" data-priority="1" width="20px">No</th>
                                    <th scope="col" data-priority="2">Lecturer</th>
                                    <th scope="col">Date Start</th>
                                    <th scope="col">Date End</th>
                                    <th scope="col" data-priority="4">Attendance</th>
                                    <th scope="col">Doc.</th>
                                    <th scope="col" data-priority="3" width="65px">Action</th>
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
            bFilter: false,
            language: {
                searchPlaceholder: 'Search by remark..',
                sSearch: '_INPUT_ &nbsp;',
                lengthMenu: '<span>Show:</span> _MENU_',
            },
            ajax: {
                url: "{{ route('api.follow_up_by_dean_id') }}",
                data: function (d) {
                    d.lecturer_id = $('#Select_1').val(),
                        d.attendance = $('#Select_2').val()
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
                        var x = "<span title='" + row.schedule.lecturer['name'] + "'>" 
                        + row.schedule.lecturer['name'] + "</span><br><a target='_blank' href='https://wa.me/" + row.schedule.lecturer['phone'] + "'><small>"
                        + row.schedule.lecturer['phone'] + "</small></a>";
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return moment(row.date_start).format("DD MMM YYYY HH:mm");
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return moment(row.date_end).format("DD MMM YYYY HH:mm");
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        if (row.remark != null) {
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
                                '<span><img class="chat-user-img img-30" src="' +
                                "{{ asset('') }}" +
                                row.image_path + '"></span>';
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.id;
                        var html =
                            `<a class="btn btn-info btn-sm px-2" title="View" href="{{ url('follow_up/` +
                            row.link + `') }}"><i class="fa fa-eye"></i></a>`;
                        return html;
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