@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Profil Pengguna</h4>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            @if ($user->level == 2)
                <p><strong>Kelas:</strong> {{ $user->kelas ?? '-' }}</p>
                <p><strong>Asal Sekolah:</strong> {{ $user->asal_sekolah ?? '-' }}</p>
            @endif
        </div>
    </div>
</div>
@endsection
