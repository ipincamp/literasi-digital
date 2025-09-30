<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
    // 1. Total siswa berdasarkan sekolah
        $totalSiswaBySekolah = DB::table('users')
        ->select('school', DB::raw('COUNT(*) as total'))
        ->groupBy('school')
        ->get();

    // 2. Total siswa berdasarkan kelas
        $totalSiswaByKelas = DB::table('users')
        ->select('class', DB::raw('COUNT(*) as total'))
        ->groupBy('class')
        ->get();

    // 3. Jumlah siswa yang sudah dan belum tes
        $siswaSudahTes = DB::table('nilai')->distinct('id_siswa')->count('id_siswa');
        $totalSiswa = DB::table('users')->count();
        $siswaBelumTes = $totalSiswa - $siswaSudahTes;

    // 4. Rata-rata nilai berdasarkan sekolah
        $rataNilaiBySekolah = DB::table('nilai')
        ->join('users', 'users.id', '=', 'nilai.id_siswa')
        ->select('users.school', DB::raw('AVG(nilai.nilai) as rata_nilai'))
        ->groupBy('users.school')
        ->get();

    // 5. Rata-rata nilai berdasarkan kelas
        $rataNilaiByKelas = DB::table('nilai')
        ->join('users', 'users.id', '=', 'nilai.id_siswa')
        ->select('users.class', DB::raw('AVG(nilai.nilai) as rata_nilai'))
        ->groupBy('users.class')
        ->get();

    // 6. 5 hasil tes terbaru
        $hasilTesTerbaru = DB::table('nilai')
        ->join('users', 'users.id', '=', 'nilai.id_siswa')
        ->select('users.name', 'users.school', 'users.class', 'nilai.nilai', 'nilai.created_at')
        ->orderByDesc('nilai.created_at')
        ->limit(5)
        ->get();

        return view('home', compact(
            'totalSiswaBySekolah',
            'totalSiswaByKelas',
            'siswaSudahTes',
            'siswaBelumTes',
            'rataNilaiBySekolah',
            'rataNilaiByKelas',
            'hasilTesTerbaru'
        ));
    }

}
