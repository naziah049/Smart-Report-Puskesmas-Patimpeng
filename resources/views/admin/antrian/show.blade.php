@extends('layouts.master')
@push('plugin-styles')
@endpush
@push('style')
<style>
    .button-container {
        display: grid;
        grid-template-columns: auto 1fr;
        align-items: center;
        margin-top: 2rem;
    }

    .right-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }
</style>
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('antrian-pasien.index') }}">Antrian Pasien</a></li>
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
                            <label class="form-label required-label">Penyakit Parah</label>
                            <input type="text" class="form-control" value="{{ $keluhan->parah }}" readonly>
                        </div>
                        @endif

                        @if ($keluhan->is_schedule == 1 && $keluhan->nomor_antrian != NULL)
                            <div class="mb-3">
                                <label class="form-label required-label">Jam</label>
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
                        <div class="button-container">
                        <a href="{{ route('antrian-pasien.index') }}" class="btn btn-secondary" type="reset">Kembali</a>
                            @if ($keluhan->nomor_antrian == NULL)
                            <div class="right-buttons">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Input Jadwal</button>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="{{ route('antrian-pasien.store', $keluhan->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="input_nomor_antrian" class="form-label">Hari - Tanggal</label>
                            <input type="text" class="form-control @error('nomor_antrian') is-invalid @enderror" id="input_nomor_antrian" name="nomor_antrian" value="{{ old('nomor_antrian') }}">
                            @error('nomor_antrian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_estimasi_jam" class="form-label">Input Estimasi Jam</label>
                            <input type="text" class="form-control @error('estimasi_jam') is-invalid @enderror" id="input_estimasi_jam" name="estimasi_jam" value="{{ old('estimasi_jam') }}">
                            @error('estimasi_jam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection
@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
