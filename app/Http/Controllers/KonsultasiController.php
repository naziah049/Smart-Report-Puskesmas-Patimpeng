<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\KonsultasiChat;
use App\Models\KonsultasiOffline;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function ajukanKonsultasi()
    {
        $data = Konsultasi::where('user_id', auth()->user()->id)->first();
        if (!$data) {
            Konsultasi::create([
                'user_id' =>  auth()->user()->id,
                'approve_admin' =>  1,
            ]);
        }
        return redirect()->route('konsultasi.chat')->with('success', 'Mulai konsultasi online');
    }

    public function ajukanKonsultasiOffline()
    {
        KonsultasiOffline::create([
            'user_id' =>  auth()->user()->id
        ]);
        return back()->with('success', 'Pengajuan konsultasi offline telah dikirim');
    }

    public function index()
    {
        $data = Konsultasi::all();
        return view('admin.konsultasi.index', compact('data'));
    }

    public function offline()
    {
        $data = KonsultasiOffline::all();
        return view('admin.konsultasi.offline', compact('data'));
    }

    public function edit(Konsultasi $konsultasi)
    {
        $konsultasi->approve_admin = 1;
        $konsultasi->save();
        return redirect()->route('konsultasi.index')->with('success', 'Pengajuan konsultasi online berhasil diterima.');
    }

    public function destroy(Konsultasi $konsultasi)
    {
        $konsultasi->delete();
        return redirect()->route('konsultasi.index')->with('success', 'Konsultasi online berhasil dihapus.');
    }

    public function chat(Konsultasi $konsultasi)
    {
        // $data = Konsultasi::where('user_id', auth()->user()->id)->first();
        // if ($data) {
        $cek = KonsultasiChat::where('konsultasi_id', $konsultasi->id)->latest()->first();
        if ($cek != NULL) {
            if ($cek->is_pasien == NULL) {
                KonsultasiChat::where('konsultasi_id', $konsultasi->id)
                    ->update([
                        'is_reading' => 1,
                    ]);
            }
        }
        $chat = KonsultasiChat::where('konsultasi_id', $konsultasi->id)->get();
        return view('pasien.konsultasi.chat', compact('konsultasi', 'chat'));
        // } else {
        //     return view('pasien.konsultasi.chat_null');
        // }
    }

    public function pilih()
    {
        $konsultasiOffline = KonsultasiOffline::where('user_id', auth()->user()->id)->latest()->first();
        return view('pasien.konsultasi.pilih_konsultasi', compact('konsultasiOffline'));
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'pesan' => 'required',
        ]);
        KonsultasiChat::create([
            'konsultasi_id' => $request->konsultasi_id,
            'chat' => $request->pesan,
            'is_pasien' => 1
        ]);
        return redirect()->route('konsultasi.chat', $request->konsultasi_id)->with('success', 'Pesan terkirim');
    }

    public function stafChat()
    {
        $data = Konsultasi::where('approve_admin', 1)->where('dokter_id', auth()->user()->id)->get();
        $unread = [];
        foreach ($data as $value) {
            $unread[$value->id] = KonsultasiChat::where('konsultasi_id', $value->id)
                ->where('is_reading', NULL)
                ->count();
        }
        return view('staff.konsultasi.index', compact('data', 'unread'));
    }

    public function showChat(Konsultasi $konsultasi)
    {
        $cek = KonsultasiChat::where('konsultasi_id', $konsultasi->id)->latest()->first();
        if ($cek != NULL) {
            if ($cek->is_pasien == 1) {
                KonsultasiChat::where('konsultasi_id', $konsultasi->id)
                    ->update([
                        'is_reading' => 1,
                    ]);
            }
        }
        $chat = KonsultasiChat::where('konsultasi_id', $konsultasi->id)->get();
        return view('staff.konsultasi.chat', compact('konsultasi', 'chat'));
    }

    public function stafKirim(Request $request)
    {
        $request->validate([
            'pesan' => 'required',
        ]);
        KonsultasiChat::create([
            'konsultasi_id' => $request->konsultasi_id,
            'chat' => $request->pesan
        ]);
        return redirect()->back();
    }

    public function showForm(KonsultasiOffline $konsultasiOffline)
    {
        return view('admin.konsultasi.form_nomor_offline', compact('konsultasiOffline'));
    }

    public function storeNomorAntrianOffline(Request $request, KonsultasiOffline $konsultasiOffline)
    {
        $konsultasiOffline->nomor_antrian = $request->nomor_antrian;
        $konsultasiOffline->save();
        return redirect()->route('offline-konsultasi.offline')->with('success', 'Nomor antrian berhasil di-input');
    }

    public function destroyKonsultasiOffline(KonsultasiOffline $konsultasiOffline)
    {
        $konsultasiOffline->delete();
        return redirect()->route('offline-konsultasi.offline')->with('success', 'Data berhasil dihapus.');
    }
}
