@extends('layouts.master-login')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-12 ps-md-2">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Smart<span>Report</span></a>
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" :value="__('Email')" class="form-label">Email
                                        address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        :value="old('email')" required autofocus>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" :value="__('Password')" class="form-label">Password</label>
                                    <input tid="password" type="password" name="password" required
                                        autocomplete="current-password" class="form-control">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="btn btn-primary me-2 mb-2 mb-md-0">
                                        {{ __('Log in') }}
                                    </x-button>
                                </div>
                            </form>
                            <h5 class="fw-normal mt-3">Belum memiliki akun? <a href="{{ url('register') }}">Daftar sekarang</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
