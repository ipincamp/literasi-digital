<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Nilai;
use App\Models\User;
use Carbon\Carbon;

class NilaiController extends Controller
{
    public function index()
    {
        $paketAktif = DB::table('paket')->where('status', 'aktif')->first();
        $idPaketAktif = $paketAktif ? $paketAktif->id : null;

        $jumlahSoal = 0;
        $allSoalIds = []; // Variabel untuk menyimpan semua ID soal

        if ($idPaketAktif) {
            $jumlahSoal = DB::table('soal')->where('paket', $idPaketAktif)->count();
            // 💡 1. Ambil semua ID soal untuk header kolom dinamis
            $allSoalIds = DB::table('soal')->where('paket', $idPaketAktif)->pluck('id')->toArray();
        }

        if (Auth::user()->level == 1) {

            // A. Kueri Agregasi (Ringkasan Nilai)
            $data = DB::table('nilai')
                ->join('soal', 'soal.id', '=', 'nilai.id_soal')
                ->where('soal.paket', $idPaketAktif)
                ->join('users', 'users.id', '=', 'nilai.id_siswa')
                ->select(
                    // 'users.id as id_siswa',
                    'nilai.id_siswa',
                    'users.name',
                    'nilai.percobaan',
                    DB::raw('SUM(nilai.nilai) as total_benar'),
                    DB::raw("($jumlahSoal) as jumlah_soal"),
                    DB::raw("CASE WHEN $jumlahSoal > 0 THEN (SUM(nilai.nilai) / $jumlahSoal) * 100 ELSE 0 END as total_nilai"),
                    DB::raw('MIN(nilai.created_at) as mulai'),
                    DB::raw('MAX(nilai.created_at) as selesai')
                )
                ->groupBy('users.id', 'users.name', 'nilai.percobaan', 'nilai.id_siswa')
                ->orderByDesc('selesai')
                ->get();

            // B. Kueri Detail (Nilai 0/1 per Soal)
            $detailAnswers = DB::table('nilai')
                ->select('id_siswa', 'percobaan', 'id_soal', 'nilai')
                ->whereIn('id_siswa', $data->pluck('id_siswa')->unique()) // Hanya ambil siswa yang ada di $data
                ->whereIn('percobaan', $data->pluck('percobaan')->unique()) // Hanya ambil percobaan yang ada di $data
                ->get();

            // C. Proses Data Menjadi Format Pivot (Mapping)
            $pivotMap = [];
            foreach ($detailAnswers as $detail) {
                // Buat kunci unik: id_siswa_percobaan
                $key = $detail->id_siswa . '_' . $detail->percobaan;
                if (!isset($pivotMap[$key])) {
                    $pivotMap[$key] = [];
                }
                // Simpan nilai (0 atau 1) dengan kunci soal_ID
                $pivotMap[$key]['soal_' . $detail->id_soal] = $detail->nilai;
            }

            // D. Gabungkan Data Pivot ke Data Agregat
            $data = $data->map(function ($item) use ($jumlahSoal, $pivotMap) {
                $key = $item->id_siswa . '_' . $item->percobaan;

                // Embed Pivot Data
                $item->soal_pivot = $pivotMap[$key] ?? [];

                // Hitung Jumlah Salah
                $item->total_salah = $item->jumlah_soal - $item->total_benar;

                return $item;
            });

            // Kirim data agregat dan ID soal ke view
            return view('nilai.admin', compact('data', 'allSoalIds'));
        } else {

            // ... (Bagian untuk Siswa, tidak diubah)
            $idSiswa = Auth::id();

            $data = DB::table('nilai')
                ->where('id_siswa', $idSiswa)
                ->join('soal', 'soal.id', '=', 'nilai.id_soal')
                ->where('soal.paket', $idPaketAktif)
                ->select(
                    'nilai.percobaan',
                    DB::raw("SUM(nilai.nilai) as total_benar"),
                    DB::raw("($jumlahSoal) as jumlah_soal"),
                    DB::raw("CASE WHEN $jumlahSoal > 0 THEN (SUM(nilai.nilai) / $jumlahSoal) * 100 ELSE 0 END as total_nilai"),
                    DB::raw('MIN(nilai.created_at) as mulai'),
                    DB::raw('MAX(nilai.created_at) as selesai')
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

    // METHOD UNTUK AJAX MODAL DETAIL
    public function getDetailJawaban($id_siswa, $percobaan)
    {
        try {
            $id_siswa = (int) $id_siswa;
            $percobaan = (int) $percobaan;

            $paketAktif = DB::table('paket')->where('status', 'aktif')->first();
            $idPaketAktif = $paketAktif ? $paketAktif->id : null;

            if (!$idPaketAktif) {
                return response()->json(['error' => 'Paket aktif tidak ditemukan'], 404);
            }

            $jumlahSoal = DB::table('soal')->where('paket', $idPaketAktif)->count();

            // Kueri yang menyebabkan error
            $data = DB::table('nilai')
                ->where('nilai.id_siswa', $id_siswa)
                ->where('nilai.percobaan', $percobaan)
                ->join('soal', 'soal.id', '=', 'nilai.id_soal')
                ->where('soal.paket', $idPaketAktif)
                ->select(
                    'nilai.id_soal',
                    'soal.soal', // 🚨 Di sini tempat nama kolom harus diverifikasi
                    'nilai.jawaban as jawaban_siswa',
                    'soal.kunci_jawaban',
                    // Menggunakan kutipan tunggal untuk keamanan ekstra
                    DB::raw("CASE WHEN nilai.nilai = 1 THEN 'Benar' ELSE 'Salah' END as status_jawaban")
                )
                ->orderBy('nilai.id_soal')
                ->get();

            $totalBenar = $data->where('status_jawaban', 'Benar')->count();
            $totalSalah = $data->where('status_jawaban', 'Salah')->count();

            return response()->json([
                'data' => $data,
                'totalBenar' => $totalBenar,
                'totalSalah' => $totalSalah,
                'totalSoal' => $jumlahSoal
            ]);
        } catch (\Exception $e) {
            // Jika terjadi error, kembalikan pesan error server untuk debugging
            // HANYA AKTIFKAN INI SELAMA DEBUGGING
            // return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500); 

            // Jika error masih 'soal.soal' yang tidak ditemukan, UBAH 'soal.soal' menjadi nama kolom yang benar di SELECT di atas.
            return response()->json(['error' => 'Terjadi kesalahan saat memproses data detail.'], 500);
        }
    }

    public function selesai()
    {
        $idSiswa = Auth::id();
        $percobaan = session('ujian_percobaan', 1);

        $paketAktif = DB::table('paket')->where('status', 'aktif')->first();
        $idPaketAktif = $paketAktif ? $paketAktif->id : null;

        $totalBenar = 0;
        $jumlahSoal = 0;
        $nilai = 0;

        if ($idPaketAktif) {
            $jumlahSoal = DB::table('soal')->where('paket', $idPaketAktif)->count();

            $totalBenar = DB::table('nilai')
                ->join('soal', 'soal.id', '=', 'nilai.id_soal')
                ->where('nilai.id_siswa', $idSiswa)
                ->where('nilai.percobaan', $percobaan)
                ->where('soal.paket', $idPaketAktif)
                ->sum('nilai');

            $nilai = $jumlahSoal > 0 ? ($totalBenar / $jumlahSoal) * 100 : 0;
        }

        $waktuMulai = session('waktu_mulai');
        $waktuSelesai = session('waktu_selesai', now());

        $lama = Carbon::parse($waktuSelesai)->diffInSeconds(Carbon::parse($waktuMulai));
        $lamaMenit = floor($lama / 60);
        $lamaDetik = $lama % 60;

        session()->forget(['waktu_mulai', 'waktu_selesai', 'ujian_percobaan']);

        return view('ujian.hasil', compact(
            'totalBenar',
            'nilai',
            'lamaMenit',
            'lamaDetik',
            'jumlahSoal'
        ));
    }

    public function exportExcel()
    {
        $paketAktif = DB::table('paket')->where('status', 'aktif')->first();
        $idPaketAktif = $paketAktif ? $paketAktif->id : null;

        if (!$idPaketAktif) {
            return redirect()->route('nilai.index')->with('error', 'Tidak ada paket ujian aktif untuk diekspor.');
        }

        $jumlahSoal = DB::table('soal')->where('paket', $idPaketAktif)->count();
        $allSoalIds = DB::table('soal')->where('paket', $idPaketAktif)->pluck('id')->toArray();

        // 1. Kueri Agregasi (Ringkasan Nilai)
        $data = DB::table('nilai')
            ->join('soal', 'soal.id', '=', 'nilai.id_soal')
            ->where('soal.paket', $idPaketAktif)
            ->join('users', 'users.id', '=', 'nilai.id_siswa')
            ->select(
                'users.id as id_siswa',
                'users.name',
                'nilai.percobaan',
                DB::raw('SUM(nilai.nilai) as total_benar'),
                DB::raw("($jumlahSoal) as jumlah_soal"),
                DB::raw("CASE WHEN $jumlahSoal > 0 THEN (SUM(nilai.nilai) / $jumlahSoal) * 100 ELSE 0 END as total_nilai"),
                DB::raw('MIN(nilai.created_at) as mulai'),
                DB::raw('MAX(nilai.created_at) as selesai')
            )
            ->groupBy('users.id', 'users.name', 'nilai.percobaan')
            ->orderByDesc('selesai')
            ->get();

        // 2. Kueri Detail (Nilai 0/1 per Soal)
        $detailAnswers = DB::table('nilai')
            ->select('id_siswa', 'percobaan', 'id_soal', 'nilai')
            ->whereIn('id_siswa', $data->pluck('id_siswa')->unique())
            ->whereIn('percobaan', $data->pluck('percobaan')->unique())
            ->get();

        // 3. Proses Data Menjadi Format Pivot
        $pivotMap = [];
        foreach ($detailAnswers as $detail) {
            $key = $detail->id_siswa . '_' . $detail->percobaan;
            if (!isset($pivotMap[$key])) {
                $pivotMap[$key] = [];
            }
            $pivotMap[$key]['soal_' . $detail->id_soal] = $detail->nilai;
        }

        // 4. Persiapan Header
        $soalHeadings = array_map(function ($index, $soalId) {
            return 'Soal ' . ($index + 1);
        }, array_keys($allSoalIds), $allSoalIds);

        $headings = array_merge([
            'ID Siswa',
            'Nama Siswa',
            'Percobaan',
            'Nilai',
            'Jml. Benar',
            'Jml. Salah',
            'Waktu Ujian',
            'Lama Pengerjaan',
        ], $soalHeadings);

        // 5. Membuat Response Stream
        $fileName = 'rekap_nilai_ujian_' . Carbon::now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            // Gunakan 'attachment' untuk memaksa download
            'Content-Disposition' => 'attachment; filename="' . $fileName . '";',
        ];

        // Membuka output stream untuk ditulis
        $callback = function () use ($data, $jumlahSoal, $pivotMap, $allSoalIds, $headings) {
            $file = fopen('php://output', 'w');

            // Tulis Header
            fputcsv($file, $headings);

            // Tulis Data Baris demi Baris
            foreach ($data as $item) {
                $key = $item->id_siswa . '_' . $item->percobaan;

                // Hitung Durasi Pengerjaan
                $mulai = Carbon::parse($item->mulai);
                $selesai = Carbon::parse($item->selesai);
                $selisih = abs($selesai->diffInSeconds($mulai));
                $m = floor($selisih / 60);
                $d = $selisih % 60;
                $lamaPengerjaan = "{$m}m " . str_pad($d, 2, '0', STR_PAD_LEFT) . 's';

                // Data Pivot (0 atau 1)
                $pivotRow = [];
                foreach ($allSoalIds as $soalId) {
                    $pivotRow[] = $pivotMap[$key]['soal_' . $soalId] ?? 0;
                }

                // Siapkan Baris Data Utama
                $rowData = [
                    $item->id_siswa,
                    $item->name,
                    $item->percobaan,
                    number_format($item->total_nilai, 2),
                    $item->total_benar,
                    $jumlahSoal - $item->total_benar,
                    Carbon::parse($item->mulai)->format('d/m/Y H:i:s'),
                    $lamaPengerjaan,
                ];

                // Gabungkan data utama dan data pivot
                $finalRow = array_merge($rowData, $pivotRow);

                fputcsv($file, $finalRow);
            }

            fclose($file);
        };

        // Mengembalikan Response Download
        return response()->stream($callback, 200, $headers);
    }
}
