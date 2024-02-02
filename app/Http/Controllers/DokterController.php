<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $dokter = $this->user::where('role', 'staff')->get();
        return view('admin.dokter.index', compact('dokter'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $model = $request->all();
        $model['role'] = 'staff';

        $this->user->create($model);
        return redirect(route('akun-dokter.index'))->with('success', 'Berhasil Simpan Data');
    }

    public function edit(User $akun_dokter)
    {
        return view('admin.dokter.edit', compact('akun_dokter'));
    }

    public function update(Request $request, User $akun_dokter)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
            $data = $request->all();
            $akun_dokter->update($data);
        } catch (\Exception $e) {
            return redirect(route('akun-dokter.index'))->with('error', 'Gagal Edit Data' . $e->getMessage());
        }
        return redirect(route('akun-dokter.index'))->with('success', 'Berhasil Edit Data');
    }

    public function destroy(User $akun_dokter)
    {
        $akun_dokter->delete();
        return redirect(route('akun-dokter.index'))->with('success', 'Berhasil Hapus Data');
    }
}
