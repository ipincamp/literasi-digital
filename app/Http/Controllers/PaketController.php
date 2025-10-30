<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::orderBy('created_at', 'desc')->get();
        return view('paket.index', compact('pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:100',
            'status' => 'required|in:aktif,non aktif',
        ]);

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Paket berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $request->validate([
            'nama_paket' => 'required|string|max:100',
            'status' => 'required|in:aktif,non aktif',
        ]);

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Data paket berhasil diperbarui');
    }

    public function destroy($id)
    {
        Paket::findOrFail($id)->delete();
        return back()->with('success', 'Paket berhasil dihapus');
    }
}
