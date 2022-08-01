@extends('layouts.master')
@section('title', 'Observation '.$data)

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2-bootstrap.css')}}">
@endsection

@section('style')
<style>
    .input-validation-error~.select2 .select2-selection {
        border: 1px solid red;
    }

</style>
@endsection

@section('breadcrumb-title')
<!-- <h3></h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Observations</li>
<li class="breadcrumb-item active">#{{ $data }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>@yield('title')</h5>
                </div>
                <div class="card-body">
                    <form class="f1" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="f1-steps">
                            <div class="f1-progress">
                                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                            </div>
                            <div class="f1-step active">
                                <div class="f1-step-icon"><i class="fa fa-file-text"></i></div>
                                <p>Observation Data</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="fa fa-clipboard"></i></div>
                                <p>Observation Form</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="fa fa-file-archive-o"></i></div>
                                <p>Observation Report</p>
                            </div>
                        </div>
                        <fieldset>
                            <div class="row">
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Lecturer</label>
                                    <input class="form-control" type="text" value="X" disabled>
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Auditor</label>
                                    <input class="form-control"  type="text" value="Y" disabled >
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Subject Course</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Topic</label>
                                    <input class="form-control"  type="text" name="" >
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Class Type</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Location</label>
                                    <input class="form-control"  type="text" name="" >
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Study Program</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Total Students</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                            </div>
                            <div class="f1-buttons">
                                <button class="btn btn-primary btn-next" type="button">Next</button>
                            </div>
                        </fieldset>
                        <fieldset>
  
                            <div class="f1-buttons">
                                <button class="btn btn-secondary btn-previous" type="button">Previous</button>
                                <button class="btn btn-primary btn-next" type="button">Next</button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Date/time</label>
                                    <input  class="form-control digits" autocomplete="off" type="datetime-local"
                                    id="date_time" name="date_time" >
                                </div>
                                <div class="mb-3 mb-2 col-lg-6 col-md-12">
                                    <label>Photo documentation</label>
                                    <input class="form-control" type="file" accept="image/*" data-bs-original-title="" title="Image Only">
                                </div>
                                <div class="mb-3 mb-2 col-lg-12 col-md-12">
                                    <label>Remark</label>
                                    <textarea class="form-control" id="remark" rows="3"></textarea>
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

</script>

<!-- <script src="{{asset('assets/js/form-wizard/form-wizard-three.js')}}"></script> -->
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

        $('.f1 input[required]').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('.f1 .btn-next').on('click', function () {
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var current_active_step = $(this).parents('.f1').find('.f1-step.active');
            var progress_line = $(this).parents('.f1').find('.f1-progress-line');
            parent_fieldset.find('input[required]').each(function () {
                if ($(this).val() == "") {
                    $(this).addClass('input-error');
                    next_step = false;
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
            $(this).find('input[required]').each(function () {
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
<script src="{{asset('assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>
@endsection
