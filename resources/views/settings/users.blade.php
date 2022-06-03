@extends('layouts.master')
@section('title', 'Users')

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
                        <select id="Select_1" class="form-control input-sm select2" data-placeholder="Roles">
                            <option value="">Roles</option>
                            @foreach($roles as $d)
                            <option value="{{ $d->id }}">{{ $d->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="Select_2" class="form-control input-sm select2" data-placeholder="Department">
                            <option value="">Department</option>
                            @foreach($department as $d)
                            <option value="{{ $d->department }}">{{ $d->department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
                        <a class="btn btn-light btn-block btn-mail" title="Sync data with klas2" href="">
                            <i data-feather="refresh-cw"></i>Sync
                        </a>
                        <a class="btn btn-primary btn-block btn-mail" title="Add new" href="{{ route('settings.user_add')}}">
                            <i data-feather="user-plus"></i>New
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
                                    <th scope="col" width="100px" class="text-center">Username</th>
                                    <th scope="col">Name / NIDN</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Dep.</th>
                                    <th scope="col">Job</th>
                                    <th scope="col" >Roles</th>
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
                url: "{{ route('api.users') }}",
                data: function (d) {
                    d.role = $('#Select_1').val(),
                        d.department = $('#Select_2').val(),
                        d.search = $('input[type="search"]').val()
                },
            },
            columns: [{
                    render: function (data, type, row, meta) {
                        var x =
                            '<img class="rounded-circle float-start chat-user-img img-30" src="' +
                            row.user_avatar + '"> <code title="' + row.username + '">' + row.username + '</code>';
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.name + "<br><small class='text-muted'>" + row.nidn +
                            "</small>";
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.email;
                        if (row.email_verified_at == null) {
                            x = "<i style='color:red' title='Email not verified'>" + row.email +
                                "</i>";
                        }
                        x = x + "<br><small class='text-muted'>" + row.phone + "</small>";
                        return x;
                    },
                },

                {
                    data: 'department',
                    name: 'department'
                },
                {
                    data: 'job',
                    name: 'job'
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        row.roles.forEach((e) => {
                            x += '<i class="badge badge-primary">' + e +
                                '</i><br>';
                        });
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.id;
                        var html =
                            `<a class="btn btn-success btn-sm px-2" title="Edit" href="{{ url('settings/user/edit/` +
                            x + `') }}"><i class="fa fa-pencil-square-o"></i></a> <a class="btn btn-danger btn-sm px-2" title="Delete" onclick="DeleteId(` + x + `)" ><i class="fa fa-trash"></i></a>`;
                        if (x != 1) {
                            return html;
                        } else {
                            return "";
                        }
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
                text: "Once deleted, you will not be able to recover this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('settings.user_delete') }}",
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
