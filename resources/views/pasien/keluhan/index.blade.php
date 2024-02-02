@extends('layouts.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Keluhan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Data Keluhan</h4>
            Catatan : <br>
            <i class="link-icon" style="color: orange" data-feather="more-horizontal"></i> Proses <br>
            <i class="link-icon" style="color: green" data-feather="check"></i> Executed <br>
            <i class="link-icon" style="color: red" data-feather="x"></i> Reject
        </div>
    </div>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Keluhan</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Keluhan</th>
                                    <th>Dokter</th>
                                    <th>Tanggal</th>
                                    <th>Proses</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->is_online == 1)
                                                Online
                                            @else
                                                Offline
                                            @endif
                                        </td>
                                        <td>{{ $item->keluhan }}</td>
                                        <td>{{ $item->dokter->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->approve_admin == NULL)
                                                <i class="link-icon" style="color: orange" data-feather="more-horizontal"></i>
                                            @elseif ($item->approve_admin == 1)
                                                <i class="link-icon" style="color: green" data-feather="check"></i>
                                            @elseif ($item->approve_admin == 2)
                                                <i class="link-icon" style="color: red" data-feather="x"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('keluhan.show', $item->id) }}" class="btn btn-sm btn-success btn-icon">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
