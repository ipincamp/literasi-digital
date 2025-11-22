@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Nilai Ujian Saya</h4>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table id="nilaiTable" class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Percobaan</th>
                    <th class="text-center">Nilai</th>
                    <th class="text-center">Tanggal Ujian</th>
                    <th class="text-center">Lama Pengerjaan</th>
                    <th class="text-center" width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td align="center">{{ $i + 1 }}</td>
                    <td align="center">{{ $item->percobaan }}</td>
                    <td align="center">{{ number_format($item->total_nilai, 2) }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($item->mulai)->format('d/m/Y H:i') }}</td>
                    <td align="center">
                        @php
                        $mulai = \Carbon\Carbon::parse($item->mulai);
                        $selesai = \Carbon\Carbon::parse($item->selesai);
                        $selisih = $selesai->diffInSeconds($mulai);
                        $m = floor($selisih / 60);
                        $d = $selisih % 60;
                        @endphp
                        {{ $m }} menit {{ str_pad($d, 2, '0', STR_PAD_LEFT) }} detik
                    </td>
                    <td align="center">
                        {{-- Tombol Modal Detail Jawaban --}}
                        <button type="button" class="btn btn-sm btn-info btn-detail text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#detailModal"
                            {{-- Menggunakan id_siswa dari item jika tersedia, jika tidak pakai Auth::id() --}}
                            data-id-siswa="{{ $item->id_siswa ?? Auth::id() }}"
                            data-percobaan="{{ $item->percobaan }}">
                            <i class="bi bi-eye"></i> Detail
                        </button>

                        {{-- Tombol Print PDF --}}
                        <a href="{{ route('refinement.show', ['id_siswa' => $item->id_siswa ?? auth()->id(), 'percobaan' => $item->percobaan]) }}"
                            class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="bi bi-printer"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ------------------------------------------------------------------------------------ --}}
{{-- 🚀 MODAL DETAIL JAWABAN --}}
{{-- ------------------------------------------------------------------------------------ --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel">Detail Jawaban Ujian - Percobaan <span id="modalPercobaan"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modalContent">
                    <p class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-detail').on('click', function() {
            var idSiswa = $(this).data('id-siswa');
            var percobaan = $(this).data('percobaan');

            $('#modalPercobaan').text(percobaan);
            $('#modalContent').html('<p class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat data...</p>');

            $.ajax({
                url: '/nilai/detail/' + idSiswa + '/' + percobaan,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Penanganan jika Controller mengembalikan error 500 eksplisit
                    if (response.error) {
                        $('#modalContent').html('<div class="alert alert-danger">Error Server: ' + response.error + '</div>');
                        return;
                    }

                    var html = `
                    <div class="row mb-4 p-2 bg-light border rounded">
                        <div class="col-md-4">Total Soal: <strong>${response.totalSoal}</strong></div>
                        <div class="col-md-4">Total Benar: <strong class="text-success">${response.totalBenar}</strong></div>
                        <div class="col-md-4">Total Salah: <strong class="text-danger">${response.totalSalah}</strong></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 45%;">Soal</th>
                                    <th style="width: 20%;">Jawaban Siswa</th>
                                    <th style="width: 20%;">Kunci Jawaban</th>
                                    <th style="width: 10%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                    $.each(response.data, function(index, item) {
                        var statusClass = item.status_jawaban === 'Benar' ? 'table-success' : 'table-danger';
                        var statusTextClass = item.status_jawaban === 'Benar' ? 'text-success fw-bold' : 'text-danger fw-bold';

                        html += `
                        <tr class="${statusClass}">
                            <td>${index + 1}</td>
                            <td>${item.soal}</td> {{-- MENGGUNAKAN item.soal SESUAI DENGAN SELECT CONTROLLER --}}
                            <td>${item.jawaban_siswa}</td>
                            <td>${item.kunci_jawaban}</td>
                            <td class="${statusTextClass}">${item.status_jawaban}</td>
                        </tr>
                    `;
                    });

                    html += `
                            </tbody>
                        </table>
                    </div>
                `;

                    $('#modalContent').html(html);
                },
                error: function(xhr, status, error) {
                    // Tampilkan respons error jika tersedia (jika server mengembalikan JSON 500)
                    try {
                        var response = JSON.parse(xhr.responseText);
                        var errorMessage = response.error || 'Server tidak merespon dengan benar.';
                        $('#modalContent').html('<div class="alert alert-danger">AJAX Error (' + xhr.status + '): ' + errorMessage + '</div>');
                    } catch (e) {
                        $('#modalContent').html('<div class="alert alert-danger">Gagal memuat detail jawaban. Status: ' + status + '. Pastikan kolom **soal.soal** ada di database.</div>');
                    }
                }
            });
        });
    });
</script>
@endpush