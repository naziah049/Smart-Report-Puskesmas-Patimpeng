<?php

namespace App\Http\Controllers;

use App\Exports\DataKeluhanExport;
use App\Models\DataKeluhan;
use App\Models\Konsultasi;
use App\Models\KonsultasiChat;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KeluhanController extends Controller
{
    public function index()
    {
        $data = DataKeluhan::where('user_id', auth()->user()->id)->get();
        return view('pasien.keluhan.index', compact('data'));
    }

    public function create()
    {
        $dokter = User::where('role', 'staff')->get();
        return view('pasien.keluhan.create', compact('dokter'));
    }

    public function createOnline()
    {
        $dokter = User::where('role', 'staff')->get();
        return view('pasien.keluhan.create_online', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required',
        ]);
        try {
            $model = $request->all();
            $model['user_id'] = auth()->user()->id;
            DataKeluhan::create($model);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal!');
        }
        return redirect()->route('keluhan.create')->with('success', 'Berhasil input keluhan');
    }

    public function show(DataKeluhan $keluhan)
    {
        $cekKonsul = Konsultasi::where('user_id', auth()->user()->id)->where('keluhan_id', $keluhan->id)->first();
        return view('pasien.keluhan.show', compact('keluhan', 'cekKonsul'));
    }

    public function adminIndex()
    {
        $data = DataKeluhan::all();
        return view('admin.keluhan.index', compact('data'));
    }

    public function adminShow(DataKeluhan $keluhan)
    {
        $keluhan->is_reading = 1;
        $keluhan->save();
        return view('admin.keluhan.show', compact('keluhan'));
    }

    public function approveKeluhan(DataKeluhan $keluhan)
    {
        $keluhan->approve_admin = 1;
        $keluhan->is_schedule = 1;
        $keluhan->save();
        return redirect()->route('keluhan-pasien.index')->with('success', 'Keluhan telah diapprove');
    }

    public function approveKeluhanDokter(DataKeluhan $keluhan)
    {
        $keluhan->approve_admin = 1;
        $keluhan->save();
        Konsultasi::create([
            'keluhan_id' =>  $keluhan->id,
            'user_id' =>  $keluhan->user_id,
            'dokter_id' =>  auth()->user()->id,
            'approve_admin' =>  1
        ]);
        return redirect()->route('keluhan-masuk.index')->with('success', 'Keluhan telah diapprove');
    }

    public function rejectKeluhan(DataKeluhan $keluhan)
    {
        $keluhan->approve_admin = 2;
        $keluhan->save();
        return redirect()->route('keluhan-pasien.index')->with('success', 'Keluhan berhasil ditolak');
    }

    public function rejectKeluhanDokter(DataKeluhan $keluhan)
    {
        $keluhan->approve_admin = 2;
        $keluhan->save();
        return redirect()->route('keluhan-masuk.index')->with('success', 'Keluhan berhasil ditolak');
    }

    public function staffIndex()
    {
        $data = DataKeluhan::where('is_online', 1)->where('dokter_id', auth()->user()->id)->get();
        return view('staff.keluhan.index', compact('data'));
    }

    public function staffShow(DataKeluhan $keluhan)
    {
        return view('staff.keluhan.show', compact('keluhan'));
    }

    public function tidakParah(Request $request, DataKeluhan $keluhan)
    {
        $request->validate([
            'resep' => 'required',
        ]);

        $keluhan->parah = 'Tidak';
        $keluhan->resep = $request->resep;
        $keluhan->save();
        return redirect()->route('keluhan-masuk.index')->with('success', 'Pasien telah diberikan resep.');
    }

    public function parah(DataKeluhan $keluhan)
    {
        $keluhan->parah = 'Ya';
        $keluhan->is_schedule = 1;
        $keluhan->save();
        return redirect()->route('keluhan-masuk.index')->with('success', 'Pasien telah diteruskan pada staf untuk pemberian jadwal.');
    }

    public function antrian()
    {
        $data = DataKeluhan::where('is_schedule', 1)->get();
        return view('admin.antrian.index', compact('data'));
    }

    public function antrianShow(DataKeluhan $keluhan)
    {
        return view('admin.antrian.show', compact('keluhan'));
    }

    public function storeAntrian(Request $request, DataKeluhan $keluhan)
    {
        $request->validate([
            'nomor_antrian' => 'required',
            'estimasi_jam' => 'required',
        ]);

        $keluhan->nomor_antrian = $request->nomor_antrian;
        $keluhan->estimasi_jam = $request->estimasi_jam;
        $keluhan->save();
        return redirect()->route('antrian-pasien.index')->with('success', 'Pasien telah diberikan nomor antrian.');
    }

    public function reportKeluhan()
    {
        $data = DataKeluhan::all();
        return view('admin.keluhan.report', compact('data'));
    }

    public function reportKeluhanExport()
    {
        $data = DataKeluhan::all();
        return Excel::download(new DataKeluhanExport($data), date('dmY') . 'Report-Keluhan.xlsx');
    }

    public function chat()
    {
        $data = Konsultasi::where('approve_admin', 1)->where('user_id', auth()->user()->id)->get();
        $unread = [];
        foreach ($data as $value) {
            $unread[$value->id] = KonsultasiChat::where('konsultasi_id', $value->id)
                ->where('is_pasien', NULL)
                ->where('is_reading', NULL)
                ->count();
        }
        return view('pasien.konsultasi.index', compact('data', 'unread'));
        $data = DataKeluhan::where('user_id', auth()->user()->id)->get();
        return view('pasien.keluhan.index', compact('data'));
    }
}
