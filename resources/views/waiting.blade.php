@extends('layouts.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
            <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">Oopps!!</h1>
            <h4 class="mb-2">Akun anda menunggu verifikasi admin</h4>
            <h6 class="text-muted mb-3 text-center">Silahkan cek beberapa saat lagi.</h6>
            <a href="{{ route('pasien.dashboard') }}" class="btn btn-primary">Cek Kembali</a>
        </div>
    </div>

</div>
@endsection
