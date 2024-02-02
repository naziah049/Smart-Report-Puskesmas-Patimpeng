@extends('layouts.master')

@section('content')
<div class="row chat-wrapper">
  <div class="col-md-12">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <a href="{{ route('ajukan.konsultasi') }}" class="btn btn-primary me-2">Mulai Konsultasi Online</a>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
    </div>
  </div>
</div>
@endsection

@push('custom-scripts')
@endpush