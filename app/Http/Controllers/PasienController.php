<?php

namespace App\Http\Controllers;

use App\Models\User;

class PasienController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $pasien = $this->user::where('role', 'pasien')->get();
        return view('admin.pasien.index', compact('pasien'));
    }

    public function edit(User $akun_pasien)
    {
        if ($akun_pasien->is_aktif == 1) {
            $status = NULL;
        } else {
            $status = 1;
        }

        $this->user::where('id', $akun_pasien->id)
            ->update([
                'is_aktif' => $status,
            ]);
        return redirect(route('akun-pasien.index'))->with('success', 'Berhasil Update Data');
    }

    public function destroy(User $akun_pasien)
    {
        $akun_pasien->delete();
        return redirect(route('akun-pasien.index'))->with('success', 'Berhasil Hapus Data');
    }
}
