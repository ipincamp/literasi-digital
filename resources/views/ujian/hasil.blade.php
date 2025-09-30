@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Hasil Ujian</h4>

    <div class="alert alert-info">
        <p><strong>Jawaban Benar:</strong> {{ $totalBenar }} dari {{ $jumlahSoal }} soal</p>
        <p><strong>Nilai Akhir:</strong> {{ number_format($nilai, 2) }}</p>
        <p><strong>Lama Pengerjaan:</strong> {{ $lamaMenit }} menit {{ str_pad($lamaDetik, 2, '0', STR_PAD_LEFT) }} detik</p>
    </div>

    {{-- Tombol Print Refinement Literasi --}}
    <div class="mt-4">
        <a href="{{ route('refinement.show', [
                'id_siswa' => auth()->id(),
                'percobaan' => session('ujian_percobaan', 1)
            ]) }}"
           target="_blank"
           class="btn btn-outline-primary">
            <i class="bi bi-printer"></i> Print PDF - Refinement Literasi
        </a>
    </div>
</div>
@endsection
