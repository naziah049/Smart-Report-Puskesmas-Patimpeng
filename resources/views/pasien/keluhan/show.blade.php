@extends('layouts.master')
@push('plugin-styles')
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('keluhan.index') }}">Data Keluhan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Detail Data Keluhan</h6>
                    <form class="forms-sample">
                        <div class="mb-3">
                            <label class="form-label">Keluhan</label>
                            <textarea class="form-control" rows="3" readonly>{{ $keluhan->keluhan }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dokter</label>
                            <input type="text" class="form-control" value="{{ $keluhan->dokter->name }}" readonly>
                        </div>
                        @if ($keluhan->parah != NULL)
                        <div class="mb-3">
                            <label class="form-label required-label">Perlu Rujukan</label>
                            <input type="text" class="form-control" value="{{ $keluhan->parah }}" readonly>
                        </div>
                        @endif

                        @if ($keluhan->is_schedule == 1)
                            <div class="mb-3">
                                <label class="form-label required-label">Jadwal</label>
                                <input type="text" class="form-control" value="{{ $keluhan->nomor_antrian }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required-label">Estimasi Jam</label>
                                <input type="text" class="form-control" value="{{ $keluhan->estimasi_jam }}" readonly>
                            </div>
                        @elseif ($keluhan->parah == 'Tidak')
                            <div class="mb-3">
                                <label class="form-label">Resep</label>
                                <textarea class="form-control" rows="3" readonly>{{ $keluhan->resep }}</textarea>
                            </div>
                        @endif
                        <a href="{{ route('keluhan.index') }}" class="btn btn-secondary" type="reset">Kembali</a>
                        @if ($cekKonsul != NULL)
                            <a href="{{ route('konsultasi.chat', $cekKonsul->id) }}" class="btn btn-primary me-2">Mulai Konsultasi Online</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
