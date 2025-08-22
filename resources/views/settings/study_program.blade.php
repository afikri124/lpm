@extends('layouts.master')
@section('title', 'Study Program')

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
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                        <select id="Select_1" class="form-control input-sm select2" data-placeholder="Acreditation">
                            <option value="">Acreditation</option>
                            @foreach($data as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-9 d-flex justify-content-center justify-content-md-end">
                        <a class="btn btn-primary btn-block btn-mail" title="Add new"
                            href="{{ route('settings.study_program_add')}}">
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
                                    <th scope="col" width="20px">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" width="50px">Level</th>
                                    <th scope="col" width="50px">Certificate</th>
                                    <th scope="col" width="50px">Acreditation</th>
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
                searchPlaceholder: 'Search...',
                sSearch: '_INPUT_ &nbsp;',
                lengthMenu: '<span>Show:</span> _MENU_',
            },
            ajax: {
                url: "{{ route('api.study_program') }}",
                data: function (d) {
                    d.acreditation = $('#Select_1').val(),
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
                        var x = row.name;
                        return x;
                    },
                },

                {
                    render: function (data, type, row, meta) {
                        var x = row.degree_level;
                        return x;
                    },
                    className: "text-center"
                },
                {
                    render: function (data, type, row, meta) {
                        if(row.certificate != null){
                            var x = '<a href="'+row.certificate+'" target="_blank"><span class="badge rounded-pill badge-success">View</span></a>';
                        } else {
                            var x = '<span class="badge rounded-pill badge-danger">not found</span>';
                        }
                        return x;
                    },
                    className: "text-center"
                },
                {
                    render: function (data, type, row, meta) {
                        if(row.acreditation_id != null){
                            var x = '<code title="'+ row.acreditation['star_point'] +'">' + row.acreditation['name'] + '</code>';
                        } else {
                            var x = "";
                        }
                        return x;
                    },
                    className: "text-center"
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.id;
                        var html =
                            `<a class="btn btn-success btn-sm px-2" title="Edit" href="{{ url('settings/study_program/edit/` +
                            row.link +
                            `') }}"><i class="fa fa-pencil-square-o"></i></a> <a class="btn btn-danger btn-sm px-2" title="Delete" onclick="DeleteId(` +
                            x + `)" ><i class="fa fa-trash"></i></a>`;
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
                        url: "{{ route('settings.study_program_delete') }}",
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
