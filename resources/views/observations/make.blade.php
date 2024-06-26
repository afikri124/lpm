@extends('layouts.master')
@section('title', 'Observation : '.$lecturer->name)

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2-bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
<style>
    .input-error~.select2-container .select2-selection--single {
        border: 1px solid red;
    }

</style>
@endsection

@section('breadcrumb-title')
<!-- <h3></h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Observations</li>
<li class="breadcrumb-item active">{{ $lecturer->name }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            @if ($data->schedule->rps_path == null)
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="fa fa-lock text-danger" style="font-size: 70pt"></h1>
                    <h5 class="text-center">Observations can't be continued because the RPS has not been uploaded by the
                        lecturer!</h5>
                    <p>Please tell the lecturer..</p>
                </div>
            </div>
            <div class="card">

                <div class="card-body row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group mb-2">
                            <label class="col-form-label">Name</label>
                            <br><strong>{{ $lecturer->name }}</strong>
                            @if ($data->practitioner != null || $data->practitioner != "")
                            / {{ $data->practitioner }}
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group mb-2">
                            <label class="col-form-label">Observation Date</label>
                            <br><strong>
                                @if($data->attendance)
                                {{ date('l, d M Y H:i', strtotime($data->updated_at)) }}
                                @else
                                {{ date('d M Y H:i', strtotime($data->schedule->date_start)) }} -
                                {{ date('d M Y H:i', strtotime($data->schedule->date_end)) }}
                                @endif
                            </strong>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group mb-2">
                            <label class="col-form-label">Contact</label>
                            <br><strong>{{ $lecturer->email }} <br>{{ $lecturer->phone }}</strong>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group mb-2">
                            <label class="col-form-label">Auditor</label> <br>
                            @if(isset($auditor))
                            @foreach($auditor as $no => $o)
                            ({{ $no + 1 }}) <strong>{{ $o->auditor->name }}</strong><br>
                            @endforeach
                            @else
                            <strong>{{ $data->auditor->name }}</strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card project-list">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="{{ url()->previous() }}">
                            <span class="btn btn-secondary">Back</span>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <form class="f1" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="f1-steps">
                            <div class="f1-progress">
                                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                            </div>
                            <div class="f1-step active">
                                <div class="f1-step-icon"><i class="fa fa-file-text"></i></div>
                                <p>Observation<br>Data</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="fa fa-clipboard"></i></div>
                                <p>Observation<br>Form</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="fa fa-file-archive-o"></i></div>
                                <p>Observation<br>Report</p>
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger outline alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                        </div>
                        @endif
                        <fieldset>
                            <div class="row">
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Lecturer</label>
                                    <input class="form-control" type="text" value="{{ $lecturer->name }}" disabled>
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Auditor</label>
                                    <input class="form-control" type="text" value="@if(isset($auditor)) @foreach($auditor as $no => $o){{ $o->auditor->name }}, @endforeach
                                        @else
                                        {{ $data->auditor->name }}
                                    @endif
                                    " disabled>
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Class Type<i class="text-danger">*</i></label>
                                    <select class="form-control input-sm select2" name="class_type"
                                        title="Select Class type" data-placeholder="Select Class type" required>
                                        <option value="" selected></option>
                                        <option value="Reguler" {{ ("Reguler" == $data->class_type ? "selected": "") }}
                                            {{ ("Reguler" == old('class_type') ? "selected": "") }}>Reguler</option>
                                        <option value="Malam" {{ ("Malam" == $data->class_type ? "selected": "") }}
                                            {{ ("Malam" == old('class_type') ? "selected": "") }}>Malam</option>
                                        <option value="Karyawan"
                                            {{ ("Karyawan" == $data->class_type ? "selected": "") }}
                                            {{ ("Karyawan" == old('class_type') ? "selected": "") }}>Karyawan</option>
                                    </select>
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Room/Location<i class="text-danger">*</i></label>
                                    <select class="form-control input-sm select2" name="location"
                                        title="Select Room/Location" data-placeholder="Select Room/Location" required>
                                        <option value="" selected></option>
                                        <option value="Online" {{ ("Online" == $data->location ? "selected": "") }}
                                            {{ ("Online" == old('location') ? "selected": "") }}>Online (Zoom/Meet/etc.)
                                        </option>
                                        @foreach($locations as $d)
                                        <option value="{{ $d->title }}"
                                            {{ ($d->title==$data->location ? "selected": "") }}
                                            {{ ($d->title==old('location') ? "selected": "") }}>
                                            {{ $d->title }}
                                        </option>
                                        @endforeach
                                        <option value="Others" {{ ("Others" == $data->location ? "selected": "") }}
                                            {{ ("Others" == old('location') ? "selected": "") }}>Others</option>
                                    </select>
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Total Students<i class="text-danger">*</i></label>
                                    <input class="form-control" type="number" name="total_students"
                                        title="Total Students"
                                        value="{{ (old('total_students')==null ? $data->total_students : old('total_students')) }}"
                                        required>
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Subject Course<i class="text-danger">*</i></label>
                                    <input class="form-control" type="text" name="subject_course" title="Subject Course"
                                        value="{{ (old('subject_course')==null ? $data->subject_course : old('subject_course')) }}"
                                        required>
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Topic</label>
                                    <input class="form-control" type="text" name="topic" title="Topic"
                                        value="{{ (old('topic')==null ? $data->topic : old('topic')) }}">
                                </div>
                                @if ($data->schedule->is_practitioner_class)
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Name of Practitioner Lecturer<i class="text-danger">*</i></label>
                                    <input class="form-control" type="text" name="practitioner"
                                        title="Dosen Praktisi Mengajar"
                                        value="{{ (old('practitioner')==null ? $data->practitioner : old('practitioner')) }}"
                                        required>
                                </div>
                                @endif
                            </div>
                            <div class="f1-buttons">
                                <a href="{{ route('observations') }}">
                                    <span class="btn btn-light">Cancel</span>
                                </a>
                                <button class="btn btn-primary btn-next" type="button">Next</button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="mb-3 col-lg-12 col-md-12">
                                <div class="alert alert-info outline alert-dismissible fade show" role="alert">
                                    <ul>
                                        <a href="{{route('rubric')}}" target="_blank"><b>Click here</b></a> to view the
                                        grading rubric guide.
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                        data-bs-original-title="" title=""></button>
                                </div>
                                <table class="table table-hover" width="100%">
                                    @foreach($survey as $key => $q)
                                    <tr valign="top">
                                        <th><strong>{{ $q->id }}</strong></th>
                                        <th colspan="2">{{ $q->title }} <u>{{ $q->description }}</u></th>
                                    </tr>
                                    @foreach($q->criterias as $no => $c)
                                    <tr valign="top">
                                        <td>{{ $q->id }}.{{ $no + 1 }}</td>
                                        <td>{{ $c->title }}
                                            <input type="hidden" name='questions[{{ $c->id }}][w]'
                                                value='{{ $c->weight }}'>
                                            <input type="hidden" name='questions[{{ $c->id }}][c]' value='{{ $q->id }}'>
                                        </td>
                                        <td>
                                            <span class="star-ratings">
                                                <select class="u-rating-fontawesome-o" name="questions[{{ $c->id }}][s]"
                                                    title="Question {{ $q->id }}.{{ $no + 1 }}" autocomplete="off"
                                                    required>
                                                    <option value="" selected>0</option>
                                                    @for ($i =1; $i <= $data->schedule->max_score; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ (old('questions.'.$c->id.'.s')==$i? "selected": "")}}>
                                                            {{ $i }}
                                                        </option>
                                                        @endfor
                                                </select>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr valign="top">
                                        <td></td>
                                        <td colspan="2">
                                            <label><i>Remark for {{ $q->id }}</i>@if( $q->is_required ) <i
                                                    class="text-danger">*</i>@endif</label>
                                            <textarea class="form-control mb-4"
                                                placeholder="@if( $q->is_required ) Required @else Additional @endif Comments"
                                                rows="2" @if(
                                                $q->is_required ) required @endif
                                                name="categories[{{ $q->id }}]">{{ old('categories.'.$q->id)}}</textarea>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="f1-buttons">
                                <button class="btn btn-secondary btn-previous" type="button">Previous</button>
                                <button class="btn btn-primary btn-next" type="button">Next</button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="mb-3 col-lg-12 col-md-12">
                                    <label>Photo documentation<i class="text-danger">*</i></label>
                                    <input class="form-control" name="image_path" type="file" accept="image/*"
                                        title="Photo documentation" data-bs-original-title="" title="only accept image"
                                        required>
                                </div>
                                <div class="mb-3 col-lg-12 col-md-12">
                                    <label>Overall Comment<i class="text-danger">*</i> <i id="count"
                                            class="text-danger">(0/350)</i></label>
                                    <textarea class="form-control" id="remark" name="remark" title="Overall comment"
                                        minlength="350" required
                                        rows="5">{{ (old('remark')==null ? $data->remark : old('remark')) }}</textarea>
                                    <i class="invalid-feedback d-block">Note: The remark must be at least 350
                                        characters.</i>
                                </div>
                            </div>
                            <div class="f1-buttons">
                                <button class="btn btn-secondary btn-previous" type="button">Previous</button>
                                <input class="btn btn-primary btn-submit" type="submit" name="submit" value="Submit">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script>
    "use strict";
    setTimeout(function () {
        (function ($) {
            "use strict";
            $(".select2").select2({
                allowClear: true,
                minimumResultsForSearch: 7,
            });
        })(jQuery);
    }, 350);
    $("#remark").keyup(function () {
        $("#count").text("(" + $(this).val().length + "/350)");
        if ($(this).val().length >= 350) {
            $("#count").removeClass('text-danger');
        } else {
            $("#count").addClass('text-danger');
        }
    });

</script>
<script src="{{asset('assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/notify/notify-script.js')}}"></script>
<script>
    'use strict';
    $(function () {
        function ratingEnable() {
            $('.u-rating-fontawesome-o').barrating({
                theme: 'fontawesome-stars-o',
                showSelectedRating: true,
                initialRating: $(this).val(),
            });
        }
        ratingEnable();
    });

</script>
<script>
    "use strict";

    function scroll_to_class(element_class, removed_height) {
        var scroll_to = $(element_class).offset().top - removed_height;
        if ($(window).scrollTop() != scroll_to) {
            $('html, body').stop().animate({
                scrollTop: scroll_to
            }, 0);
        }
    }

    function bar_progress(progress_line_object, direction) {
        var number_of_steps = progress_line_object.data('number-of-steps');
        var now_value = progress_line_object.data('now-value');
        var new_value = 0;
        if (direction == 'right') {
            new_value = now_value + (100 / number_of_steps);
        } else if (direction == 'left') {
            new_value = now_value - (100 / number_of_steps);
        }
        progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
    }
    (function ($) {
        "use strict";
        $.backstretch;
        $('#top-navbar-1').on('shown.bs.collapse', function () {
            $.backstretch("resize");
        });
        $('#top-navbar-1').on('hidden.bs.collapse', function () {
            $.backstretch("resize");
        });
        $('.f1 fieldset:first').fadeIn('slow');

        $('.f1 input[required], select[required], textarea[required]').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('select.select2').on('select2:closing', function (e) {
            $(this).removeClass('input-error');
        });
        $('.f1 .btn-next').on('click', function () {
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var current_active_step = $(this).parents('.f1').find('.f1-step.active');
            var progress_line = $(this).parents('.f1').find('.f1-progress-line');
            parent_fieldset.find('input[required], select[required], textarea[required]').each(function () {
                if ($(this).val() == "") {
                    $(this).addClass('input-error');
                    next_step = false;
                    var tes = $(this).attr('title');
                    if (tes == null || tes == '') {
                        tes = $(this).attr('name');
                    }
                    $.notify({
                        message: 'The \"' + tes + '\" field is required.'
                    }, {
                        type: 'danger',
                        allow_dismiss: true,
                        newest_on_top: false,
                        mouse_over: false,
                        showProgressbar: false,
                        spacing: 10,
                        timer: 2000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        delay: 1000,
                        z_index: 10000,
                    });
                } else {
                    $(this).removeClass('input-error');
                }
            });
            if (next_step) {
                parent_fieldset.fadeOut(400, function () {
                    current_active_step.removeClass('active').addClass('activated').next().addClass(
                        'active');
                    bar_progress(progress_line, 'right');
                    $(this).next().fadeIn();
                    scroll_to_class($('.f1'), 20);
                });
            }
        });
        $('.f1 .btn-previous').on('click', function () {
            var current_active_step = $(this).parents('.f1').find('.f1-step.active');
            var progress_line = $(this).parents('.f1').find('.f1-progress-line');
            $(this).parents('fieldset').fadeOut(400, function () {
                current_active_step.removeClass('active').prev().removeClass('activated').addClass(
                    'active');
                bar_progress(progress_line, 'left');
                $(this).prev().fadeIn();
                scroll_to_class($('.f1'), 20);
            });
        });
        $('.f1').on('submit', function (e) {
            $(this).find('input[required], select[required], textarea[required]').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    })(jQuery);

</script>
@endsection
