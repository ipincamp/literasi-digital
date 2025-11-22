@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Daftar Nilai Semua Siswa</h4>

        {{-- 💡 TOMBOL BARU: DOWNLOAD EXCEL --}}
        <a href="{{ route('nilai.export.excel') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-spreadsheet"></i> Download Rekap Excel
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm text-center">
            <thead class="table-light">
                {{-- BARIS HEADER PERTAMA (HEADER UTAMA) --}}
                <tr>
                    <th rowspan="2" class="align-middle">No</th>
                    <th rowspan="2" class="align-middle" style="min-width: 120px;">Nama Siswa</th>
                    <th rowspan="2" class="align-middle">Percobaan</th>
                    <th rowspan="2" class="align-middle">Nilai</th>
                    <th colspan="2" class="align-middle">Total Jawaban</th>
                    <th rowspan="2" class="align-middle" style="min-width: 120px;">Waktu Ujian</th>
                    <th rowspan="2" class="align-middle" style="min-width: 120px;">Lm. Pengerjaan</th>

                    {{-- HEADER PIVOT UTAMA: SOAL --}}
                    @if (isset($allSoalIds) && count($allSoalIds) > 0)
                    <th colspan="{{ count($allSoalIds) }}" class="align-middle bg-secondary text-white">SOAL</th>
                    @endif

                    <th rowspan="2" class="align-middle" style="min-width: 100px;">Aksi</th> {{-- Dikecilkan karena hanya ada Hapus --}}
                </tr>

                {{-- BARIS HEADER KEDUA (NOMOR SOAL) --}}
                <tr>
                    {{-- KOLOM RINGKASAN --}}
                    <th>Jml. Benar</th>
                    <th>Jml. Salah</th>

                    {{-- NOMOR SOAL DINAMIS --}}
                    @if (isset($allSoalIds) && count($allSoalIds) > 0)
                    @foreach($allSoalIds as $index => $soalId)
                    <th style="min-width: 40px;">{{ $index + 1 }}</th>
                    @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="text-align: left;">{{ $item->name }}</td>
                    <td>{{ $item->percobaan }}</td>
                    <td>{{ number_format($item->total_nilai, 2) }}</td>

                    {{-- DATA RINGKASAN --}}
                    <td class="text-success fw-bold">{{ $item->total_benar }}</td>
                    <td class="text-danger fw-bold">{{ $item->total_salah }}</td>

                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($item->mulai)->format('d/m/Y H:i') }}</td>
                    <td style="white-space: nowrap;">
                        @php
                        $mulai = \Carbon\Carbon::parse($item->mulai);
                        $selesai = \Carbon\Carbon::parse($item->selesai);
                        // 💡 PERBAIKAN: Gunakan fungsi abs() untuk memastikan selisih selalu positif
                        $selisih = abs($selesai->diffInSeconds($mulai));
                        $m = floor($selisih / 60);
                        $d = $selisih % 60;
                        @endphp
                        {{ $m }}m {{ str_pad($d, 2, '0', STR_PAD_LEFT) }}s
                    </td>

                    {{-- DATA PIVOT (0 atau 1) --}}
                    @if (isset($allSoalIds) && count($allSoalIds) > 0)
                    @foreach($allSoalIds as $soalId)
                    @php
                    $nilai = $item->soal_pivot['soal_' . $soalId] ?? 0;
                    $class = $nilai == 1 ? 'table-success' : 'table-danger';
                    @endphp
                    <td class="{{ $class }}">
                        {{ $nilai }}
                    </td>
                    @endforeach
                    @endif

                    <td style="white-space: nowrap;">
                        {{-- 🚫 TOMBOL DETAIL DIHILANGKAN --}}

                        {{-- Form Hapus (Saja) --}}
                        <form method="POST" action="{{ route('nilai.destroy', [$item->percobaan, $item->id_siswa]) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus data nilai percobaan {{ $item->percobaan }} untuk siswa {{ $item->name }}?')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection