@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Manajemen Paket</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle"></i> Tambah Paket
    </button>

    <div class="table-responsive">
        <table id="paketTable" class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama Paket</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pakets as $i => $paket)
                <tr>
                    <td align="center">{{ $i + 1 }}</td>
                    <td>{{ $paket->nama_paket }}</td>
                    <td align="center">
                        <span class="badge {{ $paket->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($paket->status) }}
                        </span>
                    </td>
                    <td align="center">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $paket->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $paket->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit{{ $paket->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('paket.update', $paket->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Paket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nama Paket</label>
                                        <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="aktif" {{ $paket->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="non aktif" {{ $paket->status == 'non aktif' ? 'selected' : '' }}>Non Aktif</option>
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
                <div class="modal fade" id="modalHapus{{ $paket->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('paket.destroy', $paket->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Paket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus paket <strong>{{ $paket->nama_paket }}</strong>?
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
        <div class="modal-dialog">
            <form method="POST" action="{{ route('paket.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Paket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Paket</label>
                            <input type="text" name="nama_paket" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="aktif" selected>Aktif</option>
                                <option value="non aktif">Non Aktif</option>
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
    $(document).ready(function () {
        $('#paketTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            columnDefs: [
                { orderable: false, targets: 3 }
            ]
        });
    });
</script>
@endpush
@endsection
