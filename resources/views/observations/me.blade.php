@extends('layouts.master')
@section('title', 'My PO')

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

    table.dataTable td:nth-child(3) {
        max-width: 100px;
    }

    table.dataTable td:nth-child(4) {
        max-width: 100px;
    }
    table.dataTable td:nth-child(6) {
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
<!-- <li class="breadcrumb-item">Settings</li> -->
<li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                        <select id="Select_2" class="form-control input-sm select2" data-placeholder="Status">
                            <option value="">Status</option>
                            @foreach($status as $d)
                            <option value="{{ $d->id }}">{{ $d->title }}</option>
                            @endforeach
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
                                    <th scope="col">Schedule</th>
                                    <th scope="col">Program</th>
                                    <th scope="col" data-priority="2">Auditor</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col" data-priority="4">Status</th>
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
            bFilter: false,
            language: {
                sSearch: '_INPUT_ &nbsp;',
                lengthMenu: '<span>Show:</span> _MENU_',
            },
            ajax: {
                url: "{{ route('api.schedules_by_lectrurer_id') }}",
                data: function (d) {
                        d.status_id = $('#Select_2').val()
                },
            },
            columns: [
                {
                    render: function (data, type, row, meta) {
                        var no = (meta.row + meta.settings._iDisplayStart + 1);
                        return no;
                    },
                    orderable: false,
                    className: "text-center"
                },
                {
                    render: function (data, type, row, meta) {
                        // return moment(row.date_start).format("DD MMM YYYY HH:mm");
                        var x = moment(row.date_start).format("DD MMM YY HH:mm") +
                            " - ";
                        if (moment(row.date_start).format("DD/MM/YY") == moment(row
                                .date_end).format("DD/MM/YY")) {
                            x += moment(row.date_end).format("HH:mm");
                        } else {
                            x += moment(row.date_end).format("DD MMM YY HH:mm");
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return row.study_program;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        row.observations.forEach((e) => {
                            x += '<i class="badge rounded-pill badge-' + e.color +
                                '">' + e.auditor['name'] + '</i><br>';
                        });
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        row.observations.forEach((e) => {
                            x += '<a target="_blank" href="https://wa.me/' + e.auditor['phone'] + '"><small>+' + e.auditor['phone'] + '</small></a><br>';
                        });
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = '<span title="' + row.remark + '" class="text-' + row.status['color'] + '">' + row.status['title'] + '</span>';
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.id;
                        var html = "";
                        if(row.status_id != "S00" || row.status_id != "S01"){
                            html = `<a class="btn btn-info btn-sm px-2" title="View Report" href="{{ url('pdf/report/` +
                            row.link + `') }}" target="_blank"><i class="fa fa-eye"></i></a>`;
                        } 
                        if(row.status_id == "S03" || row.status_id == "S02"){
                            html += ` <a class="btn btn-warning btn-sm px-2" title="PO Validation" href="{{ url('observations/validation/` +
                            row.link + `') }}"><i class="fa fa-legal"></i></a>`;
                        }   
                        return html;
                    },
                    orderable: false,
                    className: "text-end"
                }
            ]
        });
        $('#Select_2').change(function () {
            table.draw();
        });
    });

</script>
@endsection
