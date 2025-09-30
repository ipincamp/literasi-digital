@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Refinement Literasi</h4>

    @foreach($data as $tesletId => $items)
        @php
            $teslet = $items->first();
        @endphp

        <div class="mb-4 p-3 border rounded bg-white shadow-sm">
            <h5><strong>{{ $teslet->teslet_judul }}</strong></h5>
            @if($teslet->teslet_keterangan)
                <p><em>{{ $teslet->teslet_keterangan }}</em></p>
            @endif
            @if($teslet->teslet_gambar)
                <img src="{{ asset('storage/' . $teslet->teslet_gambar) }}" class="img-fluid mb-3" style="max-height:300px;">
            @endif

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Domain Kognitif</th>
                        <th>Indikator Literasi</th>
                        <th>Indikator Soal</th>
                        <th>Soal</th>
                        <th>Pembahasan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->domain_keterangan }}</td>
                        <td>{{ $item->indikator_keterangan }}</td>
                        <td>{{ $item->indikator_soal }}</td>
                        <td>{!! $item->soal !!}</td>
                        <td>{!! $item->pembahasan !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
@endsection
