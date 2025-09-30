<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Refinement Literasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .teslet { margin-bottom: 30px; page-break-inside: avoid; }
        .teslet h4 { margin: 0 0 5px; }
        .teslet img { max-width: 100%; height: auto; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #ccc; padding: 5px; vertical-align: top; }
        th { background: #eee; }
    </style>
</head>
<body>

    <h3 align="center">Refinement Literasi</h3>

    @foreach($data as $tesletId => $items)
        @php $teslet = $items->first(); @endphp

        <div class="teslet">
            <h4>{{ $teslet->teslet_judul }}</h4>
            @if($teslet->teslet_keterangan)
                <p><em>{{ $teslet->teslet_keterangan }}</em></p>
            @endif
            @if($teslet->teslet_gambar)
                <img src="{{ public_path('storage/' . $teslet->teslet_gambar) }}" alt="Gambar">
            @endif

            <table>
                <thead>
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
                        <td>{!! strip_tags($item->soal) !!}</td>
                        <td>{!! strip_tags($item->pembahasan) !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

</body>
</html>
