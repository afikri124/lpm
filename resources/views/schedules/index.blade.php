@extends('layouts.master')
@section('title', 'Schedules')

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
        max-width: 120px;
    }

    table.dataTable td:nth-child(3) {
        max-width: 100px;
    }

    table.dataTable td:nth-child(6) {
        max-width: 75px;
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
                        <select id="Select_1" class="form-control input-sm select2" data-placeholder="Lecturer">
                            <option value="">Lecturer</option>
                            @foreach($lecturer as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="Select_2" class="form-control input-sm select2" data-placeholder="Status">
                            <option value="">Status</option>
                            @foreach($status as $d)
                            <option value="{{ $d->id }}">{{ $d->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
                        <a class="btn btn-primary btn-block btn-mail" title="Add new" href="{{ route('schedules.add')}}">
                            <i data-feather="plus"></i>New
                        </a>
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
                                    <th scope="col" data-priority="2" >Lecturer Name</th>
                                    <th scope="col">Date Start</th>
                                    <th scope="col">Date End</th>
                                    <th scope="col" data-priority="3" >Status</th>
                                    <th scope="col">Auditor</th>
                                    <th scope="col" data-priority="4"  width="65px">Action</th>
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
                url: "{{ route('api.schedules') }}",
                data: function (d) {
                    d.lecturer_id = $('#Select_1').val(),
                        d.status_id = $('#Select_2').val(),
                        d.search = $('input[type="search"]').val()
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
                        var x = "<span title='"+ row.lecturer['name'] + "'>"+ row.lecturer['name'] + "</span>";
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
                        var x = '<span title="' + row.remark + '" class="text-' + row.status['color'] + '">' + row.status['title'] + '</span>';
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        // x = row.observations;
                        row.observations.forEach((e) => {
                            x += '<i class="badge rounded-pill badge-' + e.color +
                                '">' + e.auditor['name'] + '</i><br>';
                        });
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.id;
                        var html =
                            `<a class="btn btn-success btn-sm px-2" title="Edit" href="{{ url('schedules/edit/` +
                            row.link + `') }}"><i class="fa fa-pencil-square-o"></i></a> <a class="btn btn-danger btn-sm px-2" title="Delete" onclick="DeleteId(` + x + `)" ><i class="fa fa-trash"></i></a>`;
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

    function DeleteId(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('schedules.delete') }}",
                        type: "DELETE",
                        data: {
                            "id": id,
                            "_token": $("meta[name='csrf-token']").attr("content"),
                        },
                        success: function (data) {
                            if (data['success']) {
                                swal(data['message'], {
                                    icon: "success",
                                });
                                $('#datatable').DataTable().ajax.reload();
                            } else {
                                swal(data['message'], {
                                    icon: "error",
                                });
                            }
                        }
                    })

                }
            })
    }

</script>
@endsection
