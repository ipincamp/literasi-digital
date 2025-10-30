<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Soal;
use App\Models\Nilai;
use Carbon\Carbon;

class UjianController extends Controller
{
    public function index(Request $request)
    {
        $soals = DB::table('soal')
            ->join('paket', 'soal.paket', '=', 'paket.id') // inner join: hanya soal dengan paket
            ->leftJoin('teslet', 'soal.teslet', '=', 'teslet.id')
            ->leftJoin('domain_kognitif', 'soal.domain_kognitif', '=', 'domain_kognitif.id')
            ->leftJoin('indikator_literasi', 'soal.indikator_literasi', '=', 'indikator_literasi.id')
            ->select(
                'soal.*',
                'teslet.judul as teslet_judul',
                'teslet.keterangan as teslet_keterangan',
                'teslet.gambar as teslet_gambar',
                'domain_kognitif.keterangan as domain_keterangan',
                'indikator_literasi.keterangan as indikator_keterangan',
                'paket.nama_paket as paket_nama'
            )
            ->where('paket.status', 'aktif')
            ->orderBy('soal.id')
            ->get();


        $current = $request->get('nomor', 1);
        $soal = $soals[$current - 1] ?? null;

        // Reset waktu mulai hanya saat soal pertama
        if ($current == 1 || !session()->has('waktu_mulai')) {
            session(['waktu_mulai' => now()]);
        }

        // Inisialisasi percobaan jika belum ada
        if (!session()->has('ujian_percobaan')) {
            $lastPercobaan = Nilai::where('id_siswa', Auth::id())->max('percobaan') ?? 0;
            session(['ujian_percobaan' => $lastPercobaan + 1]);
        }

        return view('ujian.index', compact('soals', 'soal', 'current'));
    }

    public function submit(Request $request)
    {
        $soal = Soal::findOrFail($request->soal_id);
        $jawaban = $request->jawaban;
        $isBenar = strtolower($jawaban) === strtolower($soal->kunci_jawaban);
        $nilai = $isBenar ? 1 : 0;

        // Ambil percobaan dari session
        $percobaan = session('ujian_percobaan');

        // Simpan nilai
        Nilai::updateOrCreate(
            ['id_soal' => $soal->id, 'id_siswa' => Auth::id(), 'percobaan' => $percobaan],
            [
                'jawaban' => $jawaban,
                'nilai' => $nilai,
            ]
        );

        // Simpan waktu selesai jika tombol selesai diklik
        if ($request->redirect_to === 'selesai') {
            session(['waktu_selesai' => now()]);
            return redirect()->route('ujian.selesai');
        }

        return redirect()->route('ujian.index', ['nomor' => $request->nomor + 1]);
    }

    public function selesai()
    {
        $idSiswa = Auth::id();
        $percobaan = session('ujian_percobaan', 1);

        $totalBenar = Nilai::where('id_siswa', $idSiswa)
            ->where('percobaan', $percobaan)
            ->sum('nilai');

        $jumlahSoal = Soal::count();
        $nilai = $jumlahSoal > 0 ? ($totalBenar / $jumlahSoal) * 100 : 0;

        $waktuMulai = session('waktu_mulai');
        $waktuSelesai = session('waktu_selesai', now());

        $lama = Carbon::parse($waktuSelesai)->diffInSeconds(Carbon::parse($waktuMulai));
        $lamaMenit = floor($lama / 60);
        $lamaDetik = $lama % 60;

        // Bersihkan session ujian
        session()->forget(['waktu_mulai', 'waktu_selesai', 'ujian_percobaan']);

        return view('ujian.hasil', compact(
            'totalBenar',
            'nilai',
            'lamaMenit',
            'lamaDetik',
            'jumlahSoal'
        ));
    }
}
