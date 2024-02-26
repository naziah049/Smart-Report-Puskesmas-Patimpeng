<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand" style="display: flex; align-items: center;">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="30" />
            <h6 style="margin-left: 10px; font-size: 16px">Smart Report App</h6>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
      @if (Auth::user()->role == 'admin')
      <ul class="nav">
        <li class="nav-item nav-category" style="font-size: 15px">Main</li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category" style="font-size: 15px">web apps</li>
        <li class="nav-item {{ active_class(['admin/akun-dokter/*']) }}">
          <a href="{{ route('akun-dokter.index') }}" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Akun Dokter</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['admin/akun-pasien/*']) }}">
          <a href="{{ route('akun-pasien.index') }}" class="nav-link">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">Akun Pasien</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['admin/keluhan-pasien/*']) }}">
          <a href="{{ route('keluhan-pasien.index') }}" class="nav-link">
            <i class="link-icon" data-feather="file"></i>
            <span class="link-title">Data Keluhan</span>
            <span class="badge bg-success" style="position: absolute; top: 0; right: 0;">{{ $total_pasien }}</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['admin/antrian-pasien/*']) }}">
          <a href="{{ route('antrian-pasien.index') }}" class="nav-link">
            <i class="link-icon" data-feather="list"></i>
            <span class="link-title">Buat Jadwal</span>
            <span class="badge bg-success" style="position: absolute; top: 0; right: 0;">{{ $jadwal }}</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['admin/report-keluhan/*']) }}">
          <a href="{{ route('report-keluhan.index') }}" class="nav-link">
            <i class="link-icon" data-feather="inbox"></i>
            <span class="link-title">Report Keluhan</span>
          </a>
        </li>
        {{-- <li class="nav-item {{ active_class(['admin/konsultasi/*']) }}">
          <a href="{{ route('konsultasi.index') }}" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Konsultasi Online</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['admin/offline-konsultasi/*']) }}">
          <a href="{{ route('offline-konsultasi.offline') }}" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Konsultasi Offline</span>
          </a>
        </li> --}}
      </ul>
    </div>
    @endif
    @if (Auth::user()->role == 'pasien')
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{ route('pasien.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">web apps</li>
        <li class="nav-item {{ active_class(['pasien/keluhan/create']) }}">
          <a href="{{ route('keluhan.create') }}" class="nav-link">
            <i class="link-icon" data-feather="edit-3"></i>
            <span class="link-title">Pemeriksaan Offline</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['pasien/keluhan-online']) }}">
          <a href="{{ route('keluhan.online') }}" class="nav-link">
            <i class="link-icon" data-feather="message-square"></i>
            <span class="link-title">Pemeriksaan Online</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['pasien/keluhan/*']) }}">
          <a href="{{ route('keluhan.index') }}" class="nav-link">
            <i class="link-icon" data-feather="file"></i>
            <span class="link-title">Data Keluhan</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['pasien/chat/*']) }}">
          <a href="{{ route('keluhan.chat') }}" class="nav-link">
            <i class="link-icon" data-feather="message-square"></i>
            <span class="link-title" style="position: relative; display: inline-block;">Chat</span>
            <span class="badge bg-success" style="position: absolute; top: 0; right: 0;">{{ $total_unread_chat }}</span>
          </a>
        </li>
        {{-- <li class="nav-item {{ active_class(['admin/konsultasi-pilih/*']) }}">
          <a href="{{ route('konsultasi.pilih') }}" class="nav-link">
            <i class="link-icon" data-feather="message-square"></i>
            <span class="link-title">Konsultasi Online/Offline</span>
          </a>
        </li> --}}
      </ul>
    </div>
    @endif
    @if (Auth::user()->role == 'staff')
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{ route('staff.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">web apps</li>
        <li class="nav-item {{ active_class(['staff/keluhan-masuk/*']) }}">
          <a href="{{ route('keluhan-masuk.index') }}" class="nav-link">
            <i class="link-icon" data-feather="file"></i>
            <span class="link-title">Keluhan Pasien</span>
            <span class="badge bg-success" style="position: absolute; top: 0; right: 0;">{{ $total_keluhan }}</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['admin/konsultasi-stafchat/*']) }}">
          <a href="{{ route('konsultasi.stafchat') }}" class="nav-link">
            <i class="link-icon" data-feather="message-square"></i>
            <span class="link-title" style="position: relative; display: inline-block;">Konsultasi Online</span>
            <span class="badge bg-success" style="position: absolute; top: 0; right: 0;">{{ $total_unreadChat }}</span>
          </a>
        </li>
      </ul>
    </div>
    @endif
</nav>
