@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Manajemen Soal</h4>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle"></i> Tambah Soal
    </button>

    <div class="table-responsive">
        <table id="soalTable" class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Soal</th>
                    <th class="text-center">Kunci</th>
                    <th class="text-center">Domain</th>
                    <th class="text-center">Indikator</th>
                    <th class="text-center">Teslet</th>
                    <th class="text-center">Paket</th>
                    <th class="text-center" width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soals as $i => $soal)
                <tr>
                    <td align="center">{{ $i + 1 }}</td>
                    <td>{!! Str::limit(strip_tags($soal->soal), 60) !!}</td>
                    <td align="center">{{ $soal->kunci_jawaban }}</td>
                    <td>{{ $soal->domain_keterangan ?? '-' }}</td>
                    <td>{{ $soal->indikator_keterangan ?? '-' }}</td>
                    <td>
                        @if($soal->teslet_gambar)
                        <img src="{{ asset('storage/' . $soal->teslet_gambar) }}" width="100">
                        @else
                        -
                        @endif
                    </td>
                    <td>{{ $soal->paket_keterangan ?? '-' }}</td>
                    <td align="center">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $soal->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $soal->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit{{ $soal->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="{{ route('soal.update', $soal->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Soal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body row g-3">
                                    <div class="col-md-12">
                                        <label>Soal <span class="text-danger">*</span></label>
                                        <textarea name="soal" class="form-control" rows="3" required>{{ $soal->soal }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Indikator Soal <span class="text-danger">*</span></label>
                                        <textarea name="indikator_soal" class="form-control" required>{{ $soal->indikator_soal }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Pembahasan <span class="text-danger">*</span></label>
                                        <textarea name="pembahasan" class="form-control" required>{{ $soal->pembahasan }}</textarea>
                                    </div>

                                    @foreach (['a','b','c','d'] as $opt)
                                    <div class="col-md-6">
                                        <label>Pilihan {{ strtoupper($opt) }} <span class="text-danger">*</span></label>
                                        <textarea name="pilihan_{{ $opt }}" class="form-control" required>{{ $soal->{'pilihan_'.$opt} }}</textarea>
                                    </div>
                                    @endforeach

                                    <!-- pilihan E opsional -->
                                    <div class="col-md-6">
                                        <label>Pilihan E (opsional)</label>
                                        <textarea name="pilihan_e" class="form-control">{{ $soal->pilihan_e }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Kunci Jawaban <span class="text-danger">*</span></label>
                                        <select name="kunci_jawaban" class="form-control" required>
                                            <option value="">-</option>
                                            @foreach (['A','B','C','D','E'] as $kunci)
                                            <option value="{{ $kunci }}" {{ $soal->kunci_jawaban == $kunci ? 'selected' : '' }}>{{ $kunci }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Domain Kognitif <span class="text-danger">*</span></label>
                                        <select name="domain_kognitif" class="form-control" required>
                                            <option value="">-</option>
                                            @foreach ($domains as $d)
                                            <option value="{{ $d->id }}" {{ $soal->domain_kognitif == $d->id ? 'selected' : '' }}>{{ $d->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Indikator Literasi <span class="text-danger">*</span></label>
                                        <select name="indikator_literasi" class="form-control" required>
                                            <option value="">-</option>
                                            @foreach ($indikators as $i)
                                            <option value="{{ $i->id }}" {{ $soal->indikator_literasi == $i->id ? 'selected' : '' }}>{{ $i->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-8">
                                        <label>Teslet <span class="text-danger">*</span></label>
                                        <select name="teslet" class="form-control" required>
                                            <option value="">-</option>
                                            @foreach ($teslets as $t)
                                            <option value="{{ $t->id }}" {{ $soal->teslet == $t->id ? 'selected' : '' }}>
                                                {{ $t->judul ?? 'Gambar #'.$t->id }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Paket <span class="text-danger">*</span></label>
                                        <select name="paket" class="form-control" required>
                                            <option value="">-</option>
                                            @foreach ($pakets as $p)
                                            <option value="{{ $p->id }}"
                                                {{ (
                                                    (isset($soal->paket) && $soal->paket == $p->id) ||
                                                    (isset($soal->paket_id) && $soal->paket_id == $p->id)
                                                 ) ? 'selected' : '' }}>
                                                {{ $p->nama_paket }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Hapus -->
                <div class="modal fade" id="modalHapus{{ $soal->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('soal.destroy', $soal->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Soal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus soal ini?
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('soal.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Soal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label>Soal <span class="text-danger">*</span></label>
                            <textarea name="soal" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Indikator Soal <span class="text-danger">*</span></label>
                            <textarea name="indikator_soal" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Pembahasan <span class="text-danger">*</span></label>
                            <textarea name="pembahasan" class="form-control" required></textarea>
                        </div>

                        @foreach (['a','b','c','d'] as $opt)
                        <div class="col-md-6">
                            <label>Pilihan {{ strtoupper($opt) }} <span class="text-danger">*</span></label>
                            <textarea name="pilihan_{{ $opt }}" class="form-control" required></textarea>
                        </div>
                        @endforeach

                        <div class="col-md-6">
                            <label>Pilihan E (opsional)</label>
                            <textarea name="pilihan_e" class="form-control"></textarea>
                        </div>

                        <div class="col-md-4">
                            <label>Kunci Jawaban <span class="text-danger">*</span></label>
                            <select name="kunci_jawaban" class="form-control" required>
                                <option value="">-</option>
                                @foreach (['A','B','C','D','E'] as $kunci)
                                <option value="{{ $kunci }}">{{ $kunci }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Domain Kognitif <span class="text-danger">*</span></label>
                            <select name="domain_kognitif" class="form-control" required>
                                <option value="">-</option>
                                @foreach ($domains as $d)
                                <option value="{{ $d->id }}">{{ $d->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Indikator Literasi <span class="text-danger">*</span></label>
                            <select name="indikator_literasi" class="form-control" required>
                                <option value="">-</option>
                                @foreach ($indikators as $i)
                                <option value="{{ $i->id }}">{{ $i->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label>Teslet <span class="text-danger">*</span></label>
                            <select name="teslet" class="form-control" required>
                                <option value="">-</option>
                                @foreach ($teslets as $t)
                                <option value="{{ $t->id }}">{{ $t->judul ?? 'Gambar #'.$t->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Paket <span class="text-danger">*</span></label>
                            <select name="paket" class="form-control" required>
                                <option value="">-</option>
                                @foreach ($pakets as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#soalTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            columnDefs: [{
                orderable: false,
                targets: 7
            }]
        });
    });
</script>
@endpush
@endsection