@extends('layouts.master')
@push('plugin-styles')
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('keluhan-pasien.index') }}">Data Keluhan</a></li>
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
                            <label class="form-label required-label">Status</label>
                            <input type="text" class="form-control" value="@if($keluhan->approve_admin == NULL) Menunggu approve @else Diteruskan ke staf @endif" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keluhan</label>
                            <textarea class="form-control" rows="3" readonly>{{ $keluhan->keluhan }}</textarea>
                        </div>
                        @if ($keluhan->parah != NULL)
                        <div class="mb-3">
                            <label class="form-label required-label">Perlu Rujukan</label>
                            <input type="text" class="form-control" value="{{ $keluhan->parah }}" readonly>
                        </div>
                        @endif

                        @if ($keluhan->parah == 'Ya')
                            <div class="mb-3">
                                <label class="form-label required-label">Hari - Tanggal</label>
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
                        <a href="{{ route('keluhan-pasien.index') }}" class="btn btn-secondary me-2" type="reset">Kembali</a>
                        @if ($keluhan->approve_admin == NULL && $keluhan->is_online == NULl)
                            <a href="{{ route('keluhan-pasien.reject', $keluhan->id) }}" class="btn btn-danger me-2">Reject</a>
                            <a href="{{ route('keluhan-pasien.approve', $keluhan->id) }}" class="btn btn-primary">Approve</a>
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
