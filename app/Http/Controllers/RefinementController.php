<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class RefinementController extends Controller
{
    public function download($id_siswa, $percobaan)
    {
        $data = DB::table('nilai')
            ->join('soal', 'nilai.id_soal', '=', 'soal.id')
            ->leftJoin('teslet', 'soal.teslet', '=', 'teslet.id')
            ->leftJoin('domain_kognitif', 'soal.domain_kognitif', '=', 'domain_kognitif.id')
            ->leftJoin('indikator_literasi', 'soal.indikator_literasi', '=', 'indikator_literasi.id')
            ->where('nilai.id_siswa', $id_siswa)
            ->where('nilai.percobaan', $percobaan)
            ->select(
                'teslet.id as teslet_id',
                'teslet.judul as teslet_judul',
                'teslet.keterangan as teslet_keterangan',
                'teslet.gambar as teslet_gambar',
                'soal.indikator_soal',
                'soal.soal',
                'soal.pembahasan',
                'domain_kognitif.keterangan as domain_keterangan',
                'indikator_literasi.keterangan as indikator_keterangan'
            )
            ->orderBy('teslet.id')
            ->orderBy('soal.id')
            ->get()
            ->groupBy('teslet_id');

        $pdf = PDF::loadView('refinement.pdf', ['data' => $data])->setPaper('a4', 'portrait');

        return $pdf->stream('refinement-literasi.pdf'); // atau ->download('refinement.pdf');
    }
}
