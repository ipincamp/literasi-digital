<?php
// app/Http/Controllers/PetunjukController.php
namespace App\Http\Controllers;

use App\Models\Petunjuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetunjukController extends Controller
{
    public function index()
    {
        $petunjuks = DB::table('petunjuk')->orderBy('created_at', 'desc')->get();
        return view('petunjuk.index', compact('petunjuks'));
    }

    public function store(Request $request)
    {
        $request->validate(['petunjuk' => 'required']);
        DB::table('petunjuk')->insert([
            'petunjuk' => $request->petunjuk,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Petunjuk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['petunjuk' => 'required']);
        DB::table('petunjuk')->where('id', $id)->update([
            'petunjuk' => $request->petunjuk,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Petunjuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('petunjuk')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Petunjuk berhasil dihapus.');
    }
}
