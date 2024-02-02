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
            <li class="breadcrumb-item"><a href="{{ route('staff.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('keluhan-masuk.index') }}">Keluhan Masuk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                        @if ($keluhan->parah != NULL)
                        <div class="mb-3">
                            <label class="form-label required-label">Perlu Rujukan</label>
                            <input type="text" class="form-control" value="{{ $keluhan->parah }}" readonly>
                        </div>
                        @endif

                        @if ($keluhan->parah == 'Ya' && $keluhan->nomor_antrian != NULL)
                            <div class="mb-3">
                                <label class="form-label required-label">Nomor Antrian</label>
                                <input type="text" class="form-control" value="{{ $keluhan->nomor_antrian }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required-label">Estimasi Jam Giliran</label>
                                <input type="text" class="form-control" value="{{ $keluhan->estimasi_jam }}" readonly>
                            </div>
                        @elseif ($keluhan->parah == 'Tidak')
                            {{-- <div class="mb-3">
                                <label class="form-label">Tindakan</label>
                                <textarea class="form-control" rows="3" readonly>{{ $keluhan->tindakan }}</textarea>
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label">Resep</label>
                                <textarea class="form-control" rows="3" readonly>{{ $keluhan->resep }}</textarea>
                            </div>
                        @endif
                        <div class="button-container">
                            <a href="{{ route('keluhan-masuk.index') }}" class="btn btn-secondary" type="reset">Kembali</a>
                            @if ($keluhan->parah == NULL && $keluhan->approve_admin == 1)
                            <div class="right-buttons">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Tidak Perlu Rujukan</button>
                                <a href="{{ route('keluhan-masuk.parah', $keluhan->id) }}" class="btn btn-primary">Perlu Rujukan</a>
                            </div>
                            @endif
                            @if ($keluhan->approve_admin == NULL && $keluhan->is_online == 1)
                            <div class="right-buttons">
                                <a href="{{ route('keluhan-pasien.reject-dokter', $keluhan->id) }}" class="btn btn-danger me-2">Reject</a>
                                <a href="{{ route('keluhan-pasien.approve-dokter', $keluhan->id) }}" class="btn btn-primary">Approve</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Input Resep</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="{{ route('keluhan-masuk.tidak-parah', $keluhan->id) }}">
                        @csrf
                        {{-- <div class="mb-3">
                            <label for="input_tindakan" class="form-label">Tindakan</label>
                            <textarea class="form-control @error('tindakan') is-invalid @enderror" id="input_tindakan" rows="7" name="tindakan" >{{ old('tindakan') }}</textarea>
                            @error('tindakan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for="input_resep" class="form-label">Resep</label>
                            <textarea class="form-control @error('resep') is-invalid @enderror" id="input_resep" rows="7" name="resep" >{{ old('resep') }}</textarea>
                            @error('resep')
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
