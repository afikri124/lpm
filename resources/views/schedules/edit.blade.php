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

    table.dataTable tbody td {
        vertical-align: middle;
    }

    table.dataTable td:nth-child(5) {
        max-width: 120px;
    }

    table.dataTable td {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

</style>
@endsection

@section('breadcrumb-title')
<!-- <h3>Schedules</h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Schedules</li>
<li class="breadcrumb-item active">{{ $data->lecturer->name }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                        <p><i class="fa fa-exclamation-triangle"></i> {{ $error }}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Lecturer</label>
                                <br><strong>{{ $data->lecturer->name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Status</label>
                                <br><strong>
                                    <i class="text-{{ $data->status->color }}">
                                        <strong>{{ $data->status->title }}</strong>
                                    </i>
                                </strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Observation Start</label>
                                <br><strong>
                                    {{ date('l, d M Y H:i', strtotime($data->date_start)) }}
                                </strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Observation End</label>
                                <br><strong>
                                    {{ date('l, d M Y H:i', strtotime($data->date_end)) }}
                                </strong>
                            </div>
                        </div>
                        @if(count($data->follow_ups) > 0)
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Follow Up Start</label>
                                <br><strong>
                                    {{ date('l, d M Y H:i', strtotime($data->follow_ups[0]->date_start)) }}
                                </strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Follow Up End</label>
                                <br><strong>
                                    {{ date('l, d M Y H:i', strtotime($data->follow_ups[0]->date_end)) }}
                                </strong>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Follow Up By</label>
                                <br><strong>
                                    {{ $data->follow_ups[0]->dean->name_with_title }}
                                </strong>
                            </div>
                        </div>
                        @if($data->status_id == "S04" && now() > $data->follow_ups[0]->date_end)
                        <div class="col-lg-12 col-md-12">
                            <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                                <strong><i class="fa fa-exclamation-triangle"></i></strong> The follow-up date has
                                passed the specified schedule, please remind manually!
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center justify-content-md-end">
                        @if($data->status_id == "S04")
                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalRescheduleFollowUp">
                            <span class="btn btn-light" title="Reschedule Follow-Up">Reschedule Follow-Up</span>
                        </a>
                        @endif
                        @if($data->status_id != "S05" && $data->status_id != "S06")
                            <a type="button" data-bs-toggle="modal" data-bs-target="#modalReschedule">
                                <span class="btn btn-info" title="Reschedule Observations">Reschedule</span>
                            </a>
                        @endif
                        @if($data->status_id == "S04" || $data->status_id == "S05" || $data->status_id == "S06")
                        <a href="{{ route('pdf.report', ['id' => Crypt::encrypt($data->id)]) }}" target="_blank">
                            <span class="btn btn-success btn-block" title="Print Pdf">Report</span>
                        </a>
                        @endif
                        @if($data->status_id == "S00" || $data->status_id == "S01" || $data->status_id == "S02" )
                        <a type="button" id="buttonAddObserver" data-bs-toggle="modal"
                            data-bs-target="#modalAddObserver">
                            <span class="btn btn-primary" title="Add Auditor">Add</span>
                        </a>
                        @else
                        <a href="{{ route('schedules.review_observations', ['id' => Crypt::encrypt($data->id)]) }}">
                            <span class="btn btn-warning" title="Review Results">Results</span>
                        </a>
                        @endif
                        @if(($data->status_id == "S00" || $data->status_id == "S01") && now() > $data->date_end)
                        <a href="{{ route('schedules.review_observations', ['id' => Crypt::encrypt($data->id)]) }}">
                            <span class="btn btn-danger" title="Review Results">Failed Results</span>
                        </a>
                        @elseif($data->status_id == "S02" && Auth::user()->username == $hod->content && now() > $data->date_end)
                        <a href="{{ route('schedules.review_observations', ['id' => Crypt::encrypt($data->id)]) }}">
                            <span class="btn btn-danger" title="Review Results">Special Results</span>
                        </a>
                        @endif
                        <a href="{{ route('schedules') }}">
                            <span class="btn btn-secondary">Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($data->status_id == "S00" || $data->status_id == "S01" || $data->status_id == "S02")
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
    @endif
    @if($data->status_id != "S05" && $data->status_id != "S06")
    <div class="modal fade" id="modalReschedule" tabindex="-1" role="dialog" aria-labelledby="modalReschedule"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Reschedule Observation</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">Start<i class="text-danger">*</i></label>
                                    <input class="form-control digits" autocomplete="off" type="datetime-local"
                                        id="date_start" name="date_start"
                                        value="{{ date('Y-m-d\TH:i', strtotime($data->date_start)) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">End<i class="text-danger">*</i></label>
                                    <input class="form-control digits" autocomplete="off" type="datetime-local"
                                        id="date_end" name="date_end"
                                        value="{{ date('Y-m-d\TH:i', strtotime($data->date_end)) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">Status<i class="text-danger">*</i></label>
                                    <select
                                        class="form-select digits select2 @error('status') is-invalid @enderror"
                                        name="status" id="status" data-placeholder="Select">
                                        <option value="" selected disabled>Select</option>
                                        @foreach($status as $p)
                                        <option value="{{ $p->id }}" {{ $data->status_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">Is this a practitioner class?</label>
                                    <div class="form-check checkbox checkbox-default mb-0">
                                        @if($data->is_practitioner_class)
                                        <input class="form-check-input" id="is_practitioner_class" type="checkbox" value="1" checked
                                            name="is_practitioner_class">
                                        @else
                                        <input class="form-check-input" id="is_practitioner_class" type="checkbox" value="0" name="is_practitioner_class">
                                        @endif
                                        <label class="form-check-label" for="is_practitioner_class">Checklist if this is a practitioner class</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">Reason for rescheduling<i
                                            class="text-danger">*</i></label>
                                    <textarea class="form-control" rows="2" name="reschedule_reason"></textarea>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <i>Note: Schedule changes will be notified to each auditor via email, and this change
                                    can only be made for schedules whose status has not been audited.</i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @if(count($data->follow_ups) > 0)
    <div class="modal fade" id="modalRescheduleFollowUp" tabindex="-1" role="dialog"
        aria-labelledby="modalRescheduleFollowUp" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Reschedule Follow-Up</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('reschedule_follow_up', ['id' => Crypt::encrypt($data->id)] ) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">Start<i class="text-danger">*</i></label>
                                    <input class="form-control digits" autocomplete="off" type="datetime-local"
                                        id="date_start" name="date_start"
                                        value="{{ date('Y-m-d\TH:i', strtotime($data->follow_ups[0]->date_start)) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">End<i class="text-danger">*</i></label>
                                    <input class="form-control digits" autocomplete="off" type="datetime-local"
                                        id="date_end" name="date_end"
                                        value="{{ date('Y-m-d\TH:i', strtotime($data->follow_ups[0]->date_end)) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <ul class="nav nav-tabs nav-right" id="icon-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-observer-tab" data-bs-toggle="tab" href="#tab-observer"
                            role="tab" aria-controls="tab-observer" aria-selected="true">
                            <i class="icofont icofont-man-in-glasses"></i>Observer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-histories-tab" data-bs-toggle="tab" href="#tab-histories" role="tab"
                            aria-controls="tab-histories" aria-selected="false">
                            <i class="icofont icofont-history"></i>Timeline Histories
                        </a>
                    </li>
                </ul>
                <div class="card-body pt-3 tab-content">
                    <div class="tab-pane fade show active" id="tab-observer" role="tabpanel"
                        aria-labelledby="tab-observer-tab">
                        <table class="table table-hover table-sm" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" data-priority="1" width="20px">No</th>
                                    <th scope="col" data-priority="2">Auditor</th>
                                    <th scope="col" data-priority="3">Attendance</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col" data-priority="4">Doc.</th>
                                    <th scope="col" data-priority="5" width="65px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab-histories" role="tabpanel" aria-labelledby="tab-histories-tab">
                        <div class="activity-timeline">
                            <div class="media">
                                <div class="activity-dot-primary"></div>
                                <div class="media-body">
                                    <span>The observation schedule is made by
                                        <strong>{{ $data->created_user->name }}</strong>.
                                        <abbr class="fa fa-circle circle-dot-warning pull-right" data-toggle="tooltip"
                                            title="Please refresh page for latest history"
                                            onClick="window.location.reload();"></abbr>
                                    </span>
                                    <p class="font-roboto">All schedule, status, and auditor changes will be recorded in
                                        this timeline.</p>
                                </div>
                            </div>
                            @foreach($data->histories as $p)
                            <div class="media">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="media-body">
                                    <span>{!! $p->description !!}</span>
                                    @if($p->remark != null)
                                    <blockquote><i>{{ $p->remark }}</i></blockquote>
                                    @endif
                                    <p class="font-roboto"><i class="icofont icofont-clock-time"></i>
                                        {{ date('d M Y H:i', strtotime($p->created_at)) }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                            x = '<span class="badge badge-' + row.color + '">attend</span>';
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
                                "{{ asset('') }}" + row.image_path +
                                '"><img class="chat-user-img img-30" src="' +
                                "{{ asset('') }}" + row.image_path + '"></a>';
                        }
                        return x;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.id;
                        var html = '';
                        if (row.attendance == true) {
                            html =
                                `<a class="btn btn-info btn-sm px-2" title="View" target="_blank" href="{{ url('observations/results/` +
                                row.link + `') }}"><i class="fa fa-eye"></i></a>`;
                        } else {
                            html = `<a class="btn btn-danger btn-sm px-2" title="Delete" onclick="DeleteId(` +
                            x + `)" ><i class="fa fa-trash"></i></a>`
                        }
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
<script>
    $(document).ready(function () {
        const selectElement = document.querySelector('#is_practitioner_class');
        selectElement.addEventListener('change', (event) => {
            selectElement.value = selectElement.checked ? 1 : 0;
            // alert(selectElement.value);
        });
    });
</script>
@endsection
