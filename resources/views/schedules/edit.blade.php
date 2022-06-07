@extends('layouts.master')
@section('title', 'Edit Schedule')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endsection

@section('style')
<style>
    .input-validation-error~.select2 .select2-selection {
        border: 1px solid red;
    }

</style>
@endsection

@section('breadcrumb-title')
<!-- <h3>User Profile</h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Schedules</li>
<li class="breadcrumb-item">Edit</li>
<li class="breadcrumb-item active">#{{ $data->id }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Lecturer</label>
                                <input class="form-control" type="text" value="{{ $data->lecturer->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Status</label>
                                <input class="form-control" type="text" value="{{ $data->status->title }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Start</label>
                                <input class="form-control" type="text"
                                    value="{{ date('d M Y ( H:i )', strtotime($data->date_start)) }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">End</label>
                                <input class="form-control" type="text"
                                    value="{{ date('d M Y ( H:i )', strtotime($data->date_end)) }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center justify-content-md-end">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalAddObserver">
                            <span class="btn btn-primary  btn-block btn-mail"><i data-feather="plus"></i>Add
                                Observer</span>
                        </a>
                        <a href="{{ route('schedules') }}">
                            <span class="btn btn-secondary  btn-block btn-mail">Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAddObserver" tabindex="-1" role="dialog" aria-labelledby="modalAddObserver"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add Observer</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">Select Auditor<i class="text-danger">*</i></label>
                            <select class="form-select digits select2 @error('auditor_id') is-invalid @enderror"
                                name="auditor_id" id="auditor_id" data-placeholder="Select">
                                <option value="" selected disabled>Select Auditor</option>
                                @foreach($auditors as $p)
                                <option value="{{ $p->id }}" {{ ($p->id==old('auditor_id') ? "selected": "") }}>
                                    {{ $p->name }} ({{ $p->email }})
                                </option>
                                @endforeach
                            </select>
                            @error('auditor_id')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <span class="btn btn-primary" onclick="AddObserver()">Submit</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table table-hover table-sm" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" width="20px">No</th>
                                    <th scope="col">Auditor</th>
                                    <th scope="col">Attendance</th>
                                    <th scope="col">Submit Date</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Doc.</th>
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
    $(document).ready(function () {
        $("#auditor_id").select2({
            dropdownParent: $("#modalAddObserver")
        });
    });

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
                url: "{{ route('api.observations_by_schedule_id') }}",
                data: function (d) {
                    d.schedule_id = "{{ $data->id }}",
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
                        var x = row.auditor['name'];
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        if (row.attendance == true) {
                            x = '<span class="badge badge-success">attend</span>';
                        } else {
                            x = '<span class="badge badge-secondary">not yet</span>';
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        if (row.image_path != null) {
                            x = moment(row.updated_at).format("DD MMM YYYY HH:mm");
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.remark;
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = "";
                        if (row.image_path != null) {
                            x =
                                '<a target="_blank" href="' +
                                row.image_path +
                                '"><img class="rounded-circle float-start chat-user-img img-30" src="' +
                                row.image_path + '"></a>';
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.id;
                        var html =
                            `<a class="btn btn-danger btn-sm px-2" title="Delete" onclick="DeleteId(` +
                            x + `)" ><i class="fa fa-trash"></i></a>`;
                        return html;
                    },
                    orderable: false,
                    className: "text-end"
                }
            ]
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
                        url: "{{ route('observations.delete') }}",
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

    function AddObserver() {
        $('#modalAddObserver').modal('hide');
        $.ajax({
            url: "{{ route('observations.add') }}",
            type: "Post",
            data: {
                "schedule_id": "{{ $data->id }}",
                "auditor_id": document.getElementById("auditor_id").value,
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            success: function (data) {
                if (data['success']) {
                    swal(data['message'], {
                        icon: "success",
                    });
                    $("#auditor_id").val(null).trigger('change');
                    $('#datatable').DataTable().ajax.reload();
                } else {
                    swal(data['message'], {
                        icon: "error",
                    });
                }
            }
        })
        
    }

</script>
@endsection
