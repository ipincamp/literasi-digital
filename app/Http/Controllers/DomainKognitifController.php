<?php

namespace App\Http\Controllers;

use App\Models\DomainKognitif;
use Illuminate\Http\Request;

class DomainKognitifController extends Controller
{
    public function index()
    {
        $items = DomainKognitif::all();
        return view('domain.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);

        DomainKognitif::create([
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = DomainKognitif::findOrFail($id);

        $request->validate([
            'keterangan' => 'required',
        ]);

        $item->update([
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        DomainKognitif::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
