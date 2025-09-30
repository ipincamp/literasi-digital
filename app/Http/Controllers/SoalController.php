<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\DomainKognitif;
use App\Models\IndikatorLiterasi;
use App\Models\Teslet;
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
        ->select(
            'soal.*',
            'teslet.gambar as teslet_gambar',
            'domain_kognitif.keterangan as domain_keterangan',
            'indikator_literasi.keterangan as indikator_keterangan'
        )
        ->get();
        $domains = DomainKognitif::all();
        $indikators = IndikatorLiterasi::all();
        $teslets = Teslet::all();

        return view('soal.index', compact('soals', 'domains', 'indikators', 'teslets'));
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
        ]);

        Soal::create($request->all());

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
        ]);

        $soal->update($request->all());

        return back()->with('success', 'Soal berhasil diperbarui');
    }

    public function destroy($id)
    {
        Soal::findOrFail($id)->delete();
        return back()->with('success', 'Soal berhasil dihapus');
    }
}
