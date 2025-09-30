@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Ujian Pilihan Ganda</h4>

    {{-- Stopwatch --}}
    <div class="alert alert-light border mb-3">
        <strong>Lama Pengerjaan:</strong> <span id="lamaPengerjaan">Menghitung...</span>
    </div>

    {{-- Navigasi Nomor Soal --}}
    <div class="mb-3">
        @php
            $jawabanUser = \App\Models\Nilai::where('id_siswa', auth()->id())
                ->where('percobaan', session('ujian_percobaan', 1))
                ->pluck('jawaban', 'id_soal')
                ->toArray();
        @endphp

        @foreach($soals as $i => $item)
            @php
                $isAnswered = isset($jawabanUser[$item->id]);
                $btnClass = $i + 1 == $current ? 'btn-primary' : ($isAnswered ? 'btn-info text-white' : 'btn-outline-primary');
            @endphp
            <a href="{{ route('ujian.index', ['nomor' => $i + 1]) }}" class="btn btn-sm {{ $btnClass }}">
                {{ $i + 1 }}
            </a>
        @endforeach
    </div>

    {{-- Isi Soal --}}
    @if($soal)
        <form method="POST" action="{{ route('ujian.submit') }}">
            @csrf
            <input type="hidden" name="soal_id" value="{{ $soal->id }}">
            <input type="hidden" name="nomor" value="{{ $current }}">
            <input type="hidden" name="redirect_to" value="{{ $current < count($soals) ? 'next' : 'selesai' }}">

            <div class="card shadow border-0 mb-4 bg-white">
                <div class="card-body">
                    {{-- Judul Teslet --}}
                    @if($soal->teslet_judul)
                        <h5 class="mb-1 text-center"><strong>{{ $soal->teslet_judul }}</strong></h5>
                    @endif

                    {{-- Keterangan Teslet --}}
                    @if($soal->teslet_keterangan)
                        <div class="mb-3 text-muted text-center">
                            <em><i class="bi bi-info-circle"></i> {{ $soal->teslet_keterangan }}</em>
                        </div>
                    @endif

                    {{-- Gambar --}}
                    @if($soal->teslet_gambar)
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/' . $soal->teslet_gambar) }}" class="img-fluid rounded shadow" style="max-height: 350px;">
                        </div>
                    @endif

                    {{-- Isi Soal --}}
                    <div class="mb-3">
                        <p><strong>Soal {{ $current }}:</strong></p>
                        <p>{!! $soal->soal !!}</p>
                    </div>

                    {{-- Pilihan Jawaban --}}
                    @foreach(['a', 'b', 'c', 'd'] as $opsi)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="jawaban" value="{{ $opsi }}"
                                   id="opsi{{ $opsi }}" required
                                   {{ isset($jawabanUser[$soal->id]) && $jawabanUser[$soal->id] == $opsi ? 'checked' : '' }}>
                            <label class="form-check-label" for="opsi{{ $opsi }}">
                                <strong>{{ strtoupper($opsi) }}.</strong> {{ $soal->{'pilihan_'.$opsi} }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigasi Soal --}}
            <div class="d-flex justify-content-between">
                @if($current > 1)
                    <a href="{{ route('ujian.index', ['nomor' => $current - 1]) }}" class="btn btn-secondary">Kembali</a>
                @else
                    <span></span>
                @endif

                <button class="btn {{ $current < count($soals) ? 'btn-primary' : 'btn-success' }}">
                    {{ $current < count($soals) ? 'Lanjut' : 'Selesai' }}
                </button>
            </div>
        </form>
    @endif
</div>

{{-- Stopwatch Script --}}
@push('scripts')
<script>
    const waktuMulai = new Date("{{ \Carbon\Carbon::parse(session('waktu_mulai'))->format('Y-m-d H:i:s') }}");
    const waktuEl = document.getElementById("lamaPengerjaan");

    function updateTimer() {
        const now = new Date();
        let selisih = Math.floor((now - waktuMulai) / 1000);
        selisih = selisih < 1 ? 1 : selisih;
        const menit = Math.floor(selisih / 60);
        const detik = selisih % 60;
        waktuEl.textContent = `${menit} menit ${detik.toString().padStart(2, '0')} detik`;
    }

    setInterval(updateTimer, 1000);
</script>
@endpush
@endsection
