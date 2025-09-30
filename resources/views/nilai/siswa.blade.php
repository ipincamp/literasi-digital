@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Nilai Ujian Saya</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Percobaan</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Tanggal Ujian</th>
                <th class="text-center">Lama Pengerjaan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr>
                <td align="center">{{ $i + 1 }}</td>
                <td align="center">{{ $item->percobaan }}</td>
                <td align="center">{{ $item->total_nilai }}</td>
                <td align="center">{{ \Carbon\Carbon::parse($item->mulai)->format('d/m/Y H:i') }}</td>
                <td align="center">
                    @php
                    $selisih = \Carbon\Carbon::parse($item->selesai)->diffInSeconds(\Carbon\Carbon::parse($item->mulai));
                    $m = (floor($selisih / 60)) * (-1);
                    $d = ($selisih % 60) * (-1);
                    @endphp
                    {{ $m }} menit {{ str_pad($d, 2, '0', STR_PAD_LEFT) }} detik
                </td>
                <td align="center">
                    <a href="{{ route('refinement.show', ['id_siswa' => $item->id_siswa ?? auth()->id(), 'percobaan' => $item->percobaan]) }}"
                     class="btn btn-sm btn-outline-primary" target="_blank">
                     <i class="bi bi-printer"></i> Print PDF
                 </a>
             </td>
         </tr>
         @endforeach
     </tbody>
 </table>
</div>
@endsection
