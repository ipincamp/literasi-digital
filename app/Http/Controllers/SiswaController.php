<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = User::where('level', 2)->get(); // level 2 = siswa
        return view('siswa.index', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'class' => 'required',
            'school' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'class' => $request->class,
            'school' => $request->school,
            'password' => Hash::make($request->password),
            'level' => 2,
        ]);

        return back()->with('success', 'Siswa berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $siswa = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'class' => 'required',
            'school' => 'required',
        ]);

        $siswa->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'class' => $request->class,
            'school' => $request->school,
        ]);

        return back()->with('success', 'Data siswa diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Siswa dihapus');
    }
}
