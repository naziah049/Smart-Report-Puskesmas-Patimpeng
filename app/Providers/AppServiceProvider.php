<?php

namespace App\Providers;

use App\Models\DataKeluhan;
use App\Models\Konsultasi;
use App\Models\KonsultasiChat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                // Pengguna telah login, maka atur variabel global
                $data = Konsultasi::where('approve_admin', 1)->where('user_id', auth()->user()->id)->get();
                $totalUnreadChat = 0;
                foreach ($data as $value) {
                    $totalUnreadChat += KonsultasiChat::where('konsultasi_id', $value->id)
                        ->where('is_pasien', NULL)
                        ->where('is_reading', NULL)
                        ->count();
                }
                $view->with('total_unread_chat', $totalUnreadChat);

                $data_chat = Konsultasi::where('approve_admin', 1)->where('dokter_id', auth()->user()->id)->get();
                $unreadChat = 0;
                foreach ($data_chat as $value_chat) {
                    $unreadChat += KonsultasiChat::where('konsultasi_id', $value_chat->id)
                        ->where('is_reading', NULL)
                        ->count();
                }
                $view->with('total_unreadChat', $unreadChat);

                $dataKeluhan = DataKeluhan::where('is_online', 1)->where('dokter_id', auth()->user()->id)->where('approve_admin', null)->count();
                $view->with('total_keluhan', $dataKeluhan);

                $keluhan_pasien =  DataKeluhan::where('approve_admin', null)->count();
                $view->with('total_pasien', $keluhan_pasien);

                $jadwal = DataKeluhan::where('is_schedule', 1)->where('nomor_antrian', null)->count();
                $view->with('jadwal', $jadwal);
            }
        });
    }
}
