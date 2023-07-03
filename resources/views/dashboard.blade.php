@extends('layouts.master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
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

    table.dataTable td {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

</style>
@endsection

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    @if($INFO->title == "Y")
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning inverse alert-dismissible fade show" role="alert" style="font-size: 10pt;">
                <strong><i class="fa fa-info-circle"></i></strong>{{ $INFO->content }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <!-- Modal-->
    @if (Auth::user()->phone == null || Auth::user()->email == null)
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Pembaruan data pribadi diperlukan!</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-0">
                    <i>Dimohon untuk memperbarui data email/nomor handphone Anda,<br>melalui menu <a
                            href="{{ route('my_profile') }}"><b>My Profile</b></a></i><br><br>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-6 col-lg-12 xl-50 morning-sec box-col-12">
            <div class="card profile-greeting">
                <div class="card-body pb-0">
                    <div class="media">
                        <div class="media-body">
                            <div class="greeting-user m-0">
                                <h4 class="f-w-600 font-light m-0" id="greeting">Good Morning</h4>
                                <h3>{{ Auth::user()->name }}</h3>
                                <i>{{ Auth::user()->email }}   {{ Auth::user()->phone }}</i>
                                @if(Auth::user()->roles->count() == 0)
                                <p class="p-0 mb-0 text-danger">You don't have access rights, please contact the
                                    administrator!</p>
                                @else
                                <p class="p-0 mb-0 font-light">You have access rights as:</p>
                                @foreach(Auth::user()->roles as $x)
                                <i class="badge badge-secondary m-0">{{ $x->title }}</i>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <h4>
                            <div class="badge f-10 rounded-pill badge-primary"><i class="fa fa-clock-o"></i> <span
                                    id="txt"></span>
                            </div>
                        </h4>
                    </div>
                    <div class="cartoon"><img class="img-fluid" src="{{asset('/assets/images/cartoon.png')}}"
                            style="max-width: 90%;" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 xl-50 calendar-sec box-col-6">
            <div class="card gradient-primary o-hidden">
                <div class="card-body">
                    <div class="default-datepicker">
                        <div class="datepicker-here" data-language="en"></div>
                    </div>
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
                                    <th scope="col" data-priority="1" width="20px">No</th>
                                    <th scope="col" width="120px">Schedule</th>
                                    <th scope="col" data-priority="2" >Activity Histories</th>
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
<script type="text/javascript">
    $(window).on('load', function () {
        $('#myModal').modal('show');
    });

</script>
<!-- <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script> -->
<script>
    // greeting
    var today = new Date()
    var curHr = today.getHours()

    if (curHr >= 0 && curHr < 4) {
        document.getElementById("greeting").innerHTML = 'Good Night!';
    } else if (curHr >= 4 && curHr < 12) {
        document.getElementById("greeting").innerHTML = 'Good Morning!';
    } else if (curHr >= 12 && curHr < 16) {
        document.getElementById("greeting").innerHTML = 'Good Afternoon!';
    } else {
        document.getElementById("greeting").innerHTML = 'Good Evening!';
    }
    // time 
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        // var s = today.getSeconds();
        var ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12;
        h = h ? h : 12;
        m = checkTime(m);
        // s = checkTime(s);
        document.getElementById('txt').innerHTML =
            h + ":" + m + ' ' + ampm;
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }

    startTime();

</script>
<!-- <script src="{{asset('assets/js/notify/index.js')}}"></script> -->
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
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
            lengthMenu: [
                [5, 10, 100],
                [5, 10, 100],
            ],
            ajax: {
                url: "{{ route('api.histories') }}",
                data: function (d) {
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
                        return row.schedule.lecturer.name;
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        var x = row.description;
                        var ys = moment(row.created_at).format("DD-MMM-YY HH:mm");
                        var htmlx = $('<textarea />').html(x).text();
                        return "<span>["+ys+"] "+htmlx+"</span>";
                    },
                }
            ]
        });
    });

</script>
@endsection
