<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Nilai;
use App\Models\User;

class NilaiController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == 1) {
            // ADMIN - tampilkan semua nilai per siswa per percobaan
            $jumlahSoal = DB::table('soal')->count();

            $data = DB::table('nilai')
                ->join('users', 'users.id', '=', 'nilai.id_siswa')
                ->select(
                    // 'users.id as id_siswa',
                    'nilai.id_siswa',
                    'users.name',
                    'nilai.percobaan',
                    DB::raw('SUM(nilai.nilai) as total_benar'),
                    DB::raw("($jumlahSoal) as jumlah_soal"),
                    DB::raw("(SUM(nilai.nilai) / $jumlahSoal) * 100 as total_nilai"),
                    DB::raw('MIN(nilai.created_at) as mulai'),
                    DB::raw('MAX(nilai.created_at) as selesai')
                )
                ->groupBy('nilai.id_siswa', 'users.name', 'nilai.percobaan')
                ->orderByDesc('selesai')
                ->get();

            return view('nilai.admin', compact('data'));
        } else {
            // SISWA - hanya tampilkan milik sendiri
            $jumlahSoal = DB::table('soal')->count();

            $data = DB::table('nilai')
                ->where('id_siswa', Auth::id())
                ->select(
                    'percobaan',
                    DB::raw("SUM(nilai) as total_benar"),
                    DB::raw("($jumlahSoal) as jumlah_soal"),
                    DB::raw("(SUM(nilai) / $jumlahSoal) * 100 as total_nilai"),
                    DB::raw('MIN(created_at) as mulai'),
                    DB::raw('MAX(created_at) as selesai')
                )
                ->groupBy('percobaan')
                ->orderByDesc('selesai')
                ->get();

            return view('nilai.siswa', compact('data'));
        }
    }

    public function destroy($percobaan, $id_siswa)
    {
        DB::table('nilai')->where('id_siswa', $id_siswa)->where('percobaan', $percobaan)->delete();
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }
}
