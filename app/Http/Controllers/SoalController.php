<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\DomainKognitif;
use App\Models\IndikatorLiterasi;
use App\Models\Teslet;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function index()
    {
        $soals = DB::table('soal')
            ->leftJoin('teslet', 'soal.teslet', '=', 'teslet.id')
            ->leftJoin('domain_kognitif', 'soal.domain_kognitif', '=', 'domain_kognitif.id')
            ->leftJoin('indikator_literasi', 'soal.indikator_literasi', '=', 'indikator_literasi.id')
            ->leftJoin('paket', 'soal.paket', '=', 'paket.id') // tambahan join paket
            ->select(
                'soal.*',
                'teslet.gambar as teslet_gambar',
                'domain_kognitif.keterangan as domain_keterangan',
                'indikator_literasi.keterangan as indikator_keterangan',
                'paket.nama_paket as paket_keterangan' // ambil nama paket
            )
            ->get();

        $domains = DomainKognitif::all();
        $indikators = IndikatorLiterasi::all();
        $teslets = Teslet::all();
        $pakets = Paket::orderBy('nama_paket')->get(); // kirim daftar paket ke view

        return view('soal.index', compact('soals', 'domains', 'indikators', 'teslets', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'indikator_soal' => 'nullable',
            'soal' => 'nullable',
            'pilihan_a' => 'nullable',
            'pilihan_b' => 'nullable',
            'pilihan_c' => 'nullable',
            'pilihan_d' => 'nullable',
            'kunci_jawaban' => 'nullable|in:A,B,C,D',
            'pembahasan' => 'nullable',
            'domain_kognitif' => 'nullable|exists:domain_kognitif,id',
            'indikator_literasi' => 'nullable|exists:indikator_literasi,id',
            'teslet' => 'nullable|exists:teslet,id',
            'paket' => 'nullable|exists:paket,id', // validasi paket
        ]);

        // Simpan hanya field yang diperlukan (hindari mass-assignment tak terduga)
        $data = $request->only([
            'indikator_soal',
            'soal',
            'pilihan_a',
            'pilihan_b',
            'pilihan_c',
            'pilihan_d',
            'kunci_jawaban',
            'pembahasan',
            'domain_kognitif',
            'indikator_literasi',
            'teslet',
            'paket',
        ]);

        Soal::create($data);

        return back()->with('success', 'Soal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $request->validate([
            'indikator_soal' => 'nullable',
            'soal' => 'nullable',
            'pilihan_a' => 'nullable',
            'pilihan_b' => 'nullable',
            'pilihan_c' => 'nullable',
            'pilihan_d' => 'nullable',
            'kunci_jawaban' => 'nullable|in:A,B,C,D',
            'pembahasan' => 'nullable',
            'domain_kognitif' => 'nullable|exists:domain_kognitif,id',
            'indikator_literasi' => 'nullable|exists:indikator_literasi,id',
            'teslet' => 'nullable|exists:teslet,id',
            'paket' => 'nullable|exists:paket,id', // validasi paket
        ]);

        $data = $request->only([
            'indikator_soal',
            'soal',
            'pilihan_a',
            'pilihan_b',
            'pilihan_c',
            'pilihan_d',
            'kunci_jawaban',
            'pembahasan',
            'domain_kognitif',
            'indikator_literasi',
            'teslet',
            'paket',
        ]);

        $soal->update($data);

        return back()->with('success', 'Soal berhasil diperbarui');
    }

    public function destroy($id)
    {
        Soal::findOrFail($id)->delete();
        return back()->with('success', 'Soal berhasil dihapus');
    }
}
