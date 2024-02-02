@extends('layouts.master')
@push('plugin-styles')
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Nomor Antrian Konsultasi Offline</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Input Nomor Antrian Konsultasi Offline</h6>
                    <form class="forms-sample" action="{{ route('nomor-antrian.konsultasi-offline', $konsultasiOffline->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nomor Antrian</label>
                            <input type="text" name="nomor_antrian" class="form-control" required></input>
                        </div>
                        <a href="{{ route('offline-konsultasi.offline') }}" class="btn btn-secondary" type="reset">Cancel</a>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
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
