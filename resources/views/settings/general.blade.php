@extends('layouts.master')
@section('title', 'General')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>@yield('title')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item active">General</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">HoD LPM</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                        $id = null;
                        $title = null;
                        $content = null;
                        foreach($data as $d){
                        if($d->id == 'HODLPM'){
                        $id = $d->id;
                        $title = $d->title;
                        $content = $d->content;
                        }
                        }
                        @endphp
                        <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Full name with title</label>
                                <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input class="form-control" type="text" name="content" value="{{ $content }}" required>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                        <p class="text-danger m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Contact LPM</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                        $id = null;
                        $title = null;
                        $content = null;
                        foreach($data as $d){
                        if($d->id == 'CONTACT'){
                        $id = $d->id;
                        $title = $d->title;
                        $content = $d->content;
                        }
                        }
                        @endphp
                        <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Contact No.</label>
                                <input class="form-control" type="number" name="content" value="{{ $content }}"
                                    required>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                        <p class="text-danger m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Minimum Score</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                        $id = null;
                        $title = null;
                        $content = null;
                        foreach($data as $d){
                        if($d->id == 'MINSCORE'){
                        $id = $d->id;
                        $title = $d->title;
                        $content = $d->content;
                        }
                        }
                        @endphp
                        <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Minimum (%)</label>
                                <input class="form-control" type="number" name="content" value="{{ $content }}"
                                    required>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                        <p class="text-danger m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Total Auditor</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                        $id = null;
                        $title = null;
                        $content = null;
                        foreach($data as $d){
                        if($d->id == 'TOTALAUDITOR'){
                        $id = $d->id;
                        $title = $d->title;
                        $content = $d->content;
                        }
                        }
                        @endphp
                        <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Total (Min. 2)</label>
                                <input class="form-control" type="number" name="content" value="{{ $content }}"
                                    required>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                        <p class="text-danger m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">SPMI Link</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row">
                            @csrf
                            @php
                            $id = null;
                            $title = null;
                            $content = null;
                            foreach($data as $d){
                            if($d->id == 'LINKINSTRUMENT'){
                            $id = $d->id;
                            $title = $d->title;
                            $content = $d->content;
                            }
                            }
                            @endphp
                            <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Button name 1</label>
                                    <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">Link</label>
                                    <input class="form-control" type="text" name="content" value="{{ $content }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary mt-lg-4" type="submit">Update</button>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                            <p class="text-danger m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </form>
                    <form method="POST" action="">
                        <div class="row">
                            @csrf
                            @php
                            $id = null;
                            $title = null;
                            $content = null;
                            foreach($data as $d){
                            if($d->id == 'LINKINSTRUMENT2'){
                            $id = $d->id;
                            $title = $d->title;
                            $content = $d->content;
                            }
                            }
                            @endphp
                            <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Button name 2</label>
                                    <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">Link</label>
                                    <input class="form-control" type="text" name="content" value="{{ $content }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary mt-lg-4" type="submit">Update</button>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                            <p class="text-danger m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </form>
                    <form method="POST" action="">
                        <div class="row">
                            @csrf
                            @php
                            $id = null;
                            $title = null;
                            $content = null;
                            foreach($data as $d){
                            if($d->id == 'LINKINSTRUMENT3'){
                            $id = $d->id;
                            $title = $d->title;
                            $content = $d->content;
                            }
                            }
                            @endphp
                            <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Button name 3</label>
                                    <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">Link</label>
                                    <input class="form-control" type="text" name="content" value="{{ $content }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary mt-lg-4" type="submit">Update</button>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                            <p class="text-danger m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </form>
                    <form method="POST" action="">
                        <div class="row">
                            @csrf
                            @php
                            $id = null;
                            $title = null;
                            $content = null;
                            foreach($data as $d){
                            if($d->id == 'LINKINSTRUMENT4'){
                            $id = $d->id;
                            $title = $d->title;
                            $content = $d->content;
                            }
                            }
                            @endphp
                            <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Button name 4</label>
                                    <input class="form-control" type="text" name="title" value="{{ $title }}" required>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">Link</label>
                                    <input class="form-control" type="text" name="content" value="{{ $content }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary mt-lg-4" type="submit">Update</button>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                            <p class="text-danger m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Info on Dashboard</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                        $id = null;
                        $title = null;
                        $content = null;
                        foreach($data as $d){
                        if($d->id == 'INFO'){
                        $id = $d->id;
                        $title = $d->title;
                        $content = $d->content;
                        }
                        }
                        @endphp
                        <input class="form-control" type="hidden" name="id" value="{{ $id }}" required>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select id="Select_2" class="form-control input-sm select2" name="title"
                                    data-placeholder="Status" required>
                                    <option value="Y" @if($title=="Y" ) selected @endif>Active</option>
                                    <option value="N" @if($title=="N" ) selected @endif>Non Active</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Text Info</label>
                                <textarea class="form-control" name="content" required>{{ $content }}</textarea>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                        <p class="text-danger m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
