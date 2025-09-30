@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Nilai Semua Siswa</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Siswa</th>
                <th class="text-center">Percobaan</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Waktu Ujian</th>
                <th class="text-center">Lama Pengerjaan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr>
                <td align="center">{{ $i + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td align="center">{{ $item->percobaan }}</td>
                <td align="center">{{ $item->total_nilai }}</td>
                <td align="center">{{ \Carbon\Carbon::parse($item->mulai)->format('d/m/Y H:i') }}</td>
                <td align="center">
                    @php
                        $selisih = \Carbon\Carbon::parse($item->selesai)->diffInSeconds(\Carbon\Carbon::parse($item->mulai));
                        $m = floor($selisih / 60);
                        $d = $selisih % 60;
                    @endphp
                    {{ $m }} menit {{ str_pad($d, 2, '0', STR_PAD_LEFT) }} detik
                </td>
                <td align="center">
                    <form method="POST" action="{{ route('nilai.destroy', [$item->percobaan, $item->id_siswa]) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus data nilai ini?')" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
