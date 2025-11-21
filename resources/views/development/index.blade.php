@extends('layouts.master')
@section('title', 'Development Plan')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endsection

@section('style')
<style>
    .priority-card {
        margin-bottom: 1.5rem;
    }
    .indicator-item {
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 0;
    }
    .indicator-item:last-child {
        border-bottom: none;
    }
    .form-label {
        font-weight: 500;
        color: #495057;
    }
    .non-numeric-field {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>@yield('title')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Filter Tahun Akademik</h4>
                    <div class="card-options">
                        <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                            <i class="fe fe-chevron-up"></i>
                        </a>
                        <a class="card-options-remove" href="#" data-bs-toggle="card-remove">
                            <i class="fe fe-x"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('development') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Akademik</label>
                                    <select name="year" class="form-control select2" onchange="this.form.submit()">
                                        @if($years->count() > 0)
                                            @foreach($years as $year)
                                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                            @endforeach
                                        @else
                                            <option value="">Tidak ada data</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!$plans->isEmpty())
    <form id="developmentForm" method="POST" action="{{ route('development.bulk-update') }}">
        @csrf
        @php
        $priorityNumber = 1;
        @endphp
        @foreach($plans as $priority => $items)
        <div class="row priority-card">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Prioritas {{ $priorityNumber }}: {{ $priority }}</h4>
                        <div class="card-options">
                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                                <i class="fe fe-chevron-up"></i>
                            </a>
                            <a class="card-options-remove" href="#" data-bs-toggle="card-remove">
                                <i class="fe fe-x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($items as $index => $item)
                        <div class="indicator-item">
                            <input type="hidden" name="updates[{{ $item->id }}][id]" value="{{ $item->id }}">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label class="form-label fw-bold">{{ $item->uraian }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Rencana</label>
                                        @if(!$item->is_numeric)
                                        <select name="updates[{{ $item->id }}][rencana]" 
                                                class="form-control select2 non-numeric-field" 
                                                data-placeholder="Pilih Akreditasi">
                                            <option value="C/Baik" {{ $item->rencana == 'C/Baik' ? 'selected' : '' }}>C/Baik</option>
                                            <option value="B/Baik Sekali" {{ $item->rencana == 'B/Baik Sekali' ? 'selected' : '' }}>B/Baik Sekali</option>
                                            <option value="A/Unggul" {{ $item->rencana == 'A/Unggul' ? 'selected' : '' }}>A/Unggul</option>
                                        </select>
                                        @else
                                        <input type="number" 
                                               name="updates[{{ $item->id }}][rencana]" 
                                               class="form-control" 
                                               value="{{ $item->rencana }}" 
                                               step="0.01" 
                                               min="0">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Target Tercapai</label>
                                        <input type="number" 
                                               name="updates[{{ $item->id }}][tercapai]" 
                                               class="form-control" 
                                               value="{{ $item->tercapai }}" 
                                               step="0.01" 
                                               min="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Link Eviden</label>
                                        <input type="url" 
                                               name="updates[{{ $item->id }}][link]" 
                                               class="form-control" 
                                               value="{{ $item->link }}" 
                                               placeholder="https://example.com/eviden.pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @php
        $priorityNumber++;
        @endphp
        @endforeach

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-secondary" onclick="location.reload()">Reset</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fa fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Data Belum Tersedia</h5>
                        <p class="mb-0">Data rencana pengembangan untuk tahun akademik <strong>{{ $selectedYear }}</strong> belum tersedia.</p>
                        <hr>
                        <p class="mb-0">Silakan jalankan seeder untuk mengisi data awal:</p>
                        <code class="d-block mt-2">php artisan db:seed --class=DevelopmentPlanSeeder</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Pilih opsi',
            allowClear: true
        });

        $('#developmentForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const updates = {};
            
            // Convert FormData to object
            formData.forEach((value, key) => {
                const match = key.match(/updates\[(\d+)\]\[(\w+)\]/);
                if (match) {
                    const id = match[1];
                    const field = match[2];
                    if (!updates[id]) {
                        updates[id] = { id: id };
                    }
                    updates[id][field] = value;
                }
            });

            // Convert to array
            const updatesArray = Object.values(updates);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    updates: updatesArray
                },
                beforeSend: function() {
                    $('#submitBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Data berhasil diperbarui',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message || 'Terjadi kesalahan saat menyimpan data'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan saat menyimpan data';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage
                    });
                },
                complete: function() {
                    $('#submitBtn').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                }
            });
        });
    });
</script>
@endsection
