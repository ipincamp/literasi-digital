<?php

namespace App\Http\Controllers;

use App\Models\IndikatorLiterasi;
use Illuminate\Http\Request;

class IndikatorLiterasiController extends Controller
{
    public function index()
    {
        $items = IndikatorLiterasi::all();
        return view('indikator.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate(['keterangan' => 'required']);

        IndikatorLiterasi::create([
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = IndikatorLiterasi::findOrFail($id);

        $request->validate(['keterangan' => 'required']);

        $item->update([
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        IndikatorLiterasi::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
