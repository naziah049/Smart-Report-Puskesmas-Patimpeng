@extends('layouts.master')

@section('content')
@include('components.alert')
<div class="row chat-wrapper">
  <div class="col-md-12" style="text-align: center">
    <a href="{{ route('ajukan.konsultasi') }}" class="btn btn-primary me-2 mb-3">Mulai Konsultasi Online</a> <br>
    
    @if ($konsultasiOffline != NULL)
      @if ($konsultasiOffline->nomor_antrian != NULL)
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Nomor antrian konsultasi offline anda : {{ $konsultasiOffline->nomor_antrian }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
      </div>
      @else
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Pengajuan konsultasi offline belum diproses admin
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
      </div>
      @endif
    @else
      <a href="{{ route('ajukan.konsultasi-offline') }}" class="btn btn-primary me-2">Ajukan Konsultasi Offline</a>
    @endif
  </div>
</div>
@endsection

@push('custom-scripts')
@endpush