@extends('layouts.master')
@push('plugin-styles')
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Keluhan</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Input Keluhan</h6>
                    <form class="forms-sample" action="{{ route('keluhan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input_keluhan" class="form-label">Keluhan</label>
                            <textarea name="keluhan" class="form-control @error('keluhan') is-invalid @enderror"
                                id="input_keluhan" rows="3">{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_dokter" class="form-label">Dokter</label>
                            <select name="dokter_id" class="form-control">
                                <option value="" selected disabled>Pilih Dokter</option>
                                @foreach ($dokter as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('dokter_id')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <a href="{{ route('pasien.dashboard') }}" class="btn btn-secondary" type="reset">Cancel</a>
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
