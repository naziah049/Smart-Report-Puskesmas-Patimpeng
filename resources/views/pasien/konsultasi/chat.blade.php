@extends('layouts.master')

@section('content')
<div class="row chat-wrapper">
  <div class="col-md-12">
    @if ($konsultasi->approve_admin)
    <div class="card">
      <div class="card-body">
        <div class="row position-relative">
          <div class="col-lg-12 chat-content show">
            <div class="chat-header border-bottom pb-2">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <figure class="mb-0 me-2">
                    <img src="{{ asset('noimage/no-user-image.png') }}" class="img-sm rounded-circle" alt="image">
                    <div class="status online"></div>
                    <div class="status online"></div>
                  </figure>
                  <div>
                    <p>{{ $konsultasi->dokter->name }}</p>
                    <p class="text-muted tx-13">{{ $konsultasi->dokter->email }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="chat-body" id="message-list">
              <ul class="messages">
                @foreach ($chat as $item)
                  @if ($item->is_pasien)
                    <li class="message-item me">
                      <div class="content">
                        <div class="message">
                          <div class="bubble">
                            <p>{{ $item->chat }}</p>
                          </div>
                          <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span>
                        </div>
                      </div>
                    </li>
                  @else
                    <li class="message-item friend">
                      <img src="{{ asset('noimage/no-user-image.png') }}" class="img-xs rounded-circle" alt="avatar">
                      <div class="content">
                        <div class="message">
                          <div class="bubble">
                            <p>{{ $item->chat }}</p>
                          </div>
                          <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span>
                        </div>
                      </div>
                    </li>
                  @endif
                @endforeach
              </ul>
            </div>
            <div class="chat-footer d-flex">
              <div>
                <a href="{{ route('konsultasi.chat', $konsultasi->id) }}">
                  <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Emoji">
                    <i data-feather="refresh-ccw" class="text-muted"></i>
                  </button>
                </a>
              </div>
              <form class="search-form flex-grow-1 me-2" method="POST" action="{{ route('konsultasi.kirim') }}" id="chatForm">
                @csrf
                <div class="input-group">
                  <input type="hidden" name="konsultasi_id" value="{{ $konsultasi->id }}">
                  <input type="text" class="form-control rounded-pill" name="pesan" placeholder="Type a message" autofocus>
                </div>
              </form>
              <div>
                <button type="button" class="btn btn-primary btn-icon rounded-circle" id="sendButton">
                  <i data-feather="send"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      Pengajuan konsultasi online anda belum di approve.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
    </div>
    @endif
  </div>
</div>
@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/js/chat.js') }}"></script>
  <script>
    $(document).ready(function () {
      const element = document.getElementById('message-list');
      element.scrollTop = element.scrollHeight;

      $('#sendButton').click(function () {
        $('#chatForm').submit();
      });
    });
  </script>
@endpush