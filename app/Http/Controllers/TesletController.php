<?php

namespace App\Http\Controllers;

use App\Models\Teslet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TesletController extends Controller
{
    public function index()
    {
        $items = Teslet::all();
        return view('teslet.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable',
        ]);

        $gambarPath = $request->file('gambar')->store('teslet', 'public');

        Teslet::create([
            'judul' => $request->judul,
            'gambar' => $gambarPath,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Teslet berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $teslet = Teslet::findOrFail($id);

        $data = $request->validate([
            'judul' => 'nullable',
            'keterangan' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($teslet->gambar && Storage::disk('public')->exists($teslet->gambar)) {
                Storage::disk('public')->delete($teslet->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('teslet', 'public');
        }

        $teslet->update($data);

        return back()->with('success', 'Teslet berhasil diperbarui');
    }

    public function destroy($id)
    {
        $teslet = Teslet::findOrFail($id);

        if ($teslet->gambar && Storage::disk('public')->exists($teslet->gambar)) {
            Storage::disk('public')->delete($teslet->gambar);
        }

        $teslet->delete();

        return back()->with('success', 'Teslet berhasil dihapus');
    }
}
