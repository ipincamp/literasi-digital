@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Petunjuk</h4>

    @if (session('success') && auth()->user()->level == 1)
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol tambah hanya untuk admin --}}
    @if(auth()->user()->level == 1)
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle"></i> Tambah Petunjuk
    </button>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Isi Petunjuk</th>
                @if(auth()->user()->level == 1)
                <th width="100">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($petunjuks as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{!! $item->petunjuk !!}</td>

                @if(auth()->user()->level == 1)
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form method="POST" action="{{ route('petunjuk.destroy', $item->id) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
                @endif
            </tr>

            {{-- Modal Edit (hanya untuk admin) --}}
            @if(auth()->user()->level == 1)
            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('petunjuk.update', $item->id) }}">
                        @csrf @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Petunjuk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <textarea id="editorEdit{{ $item->id }}" name="petunjuk" class="form-control">{{ $item->petunjuk }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @endforeach
        </tbody>
    </table>

    {{-- Modal Tambah (hanya untuk admin) --}}
    @if(auth()->user()->level == 1)
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('petunjuk.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Petunjuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <textarea id="editorTambah" name="petunjuk" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

@push('scripts')
@if(auth()->user()->level == 1)
<!-- CKEditor hanya untuk admin -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editorTambah')).catch(error => console.error(error));
    @foreach($petunjuks as $item)
    ClassicEditor.create(document.querySelector('#editorEdit{{ $item->id }}')).catch(error => console.error(error));
    @endforeach
</script>
@endif
@endpush
@endsection