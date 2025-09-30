@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Dashboard Statistik Siswa</h4>

    <div class="row">
        {{-- 1. Grafik jumlah siswa berdasarkan asal sekolah --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Jumlah Siswa per Sekolah</div>
                <div class="card-body">
                    <canvas id="chartSiswaBySekolah"></canvas>
                </div>
            </div>
        </div>

        {{-- 2. Grafik jumlah siswa berdasarkan kelas --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Jumlah Siswa per Kelas</div>
                <div class="card-body">
                    <canvas id="chartSiswaByKelas"></canvas>
                </div>
            </div>
        </div>

        {{-- 4. Grafik rata-rata nilai per sekolah --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Rata-rata Nilai per Sekolah</div>
                <div class="card-body">
                    <canvas id="chartRataNilaiBySekolah"></canvas>
                </div>
            </div>
        </div>

        {{-- 5. Grafik rata-rata nilai per kelas --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Rata-rata Nilai per Kelas</div>
                <div class="card-body">
                    <canvas id="chartRataNilaiByKelas"></canvas>
                </div>
            </div>
        </div>

        {{-- 3. Grafik jumlah siswa sudah vs belum tes --}}
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header">Status Tes Siswa</div>
                <div class="card-body">
                    <canvas id="chartTesStatus"></canvas>
                </div>
            </div>
        </div>

        {{-- 6. Tabel hasil tes terbaru --}}
        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-header">5 Hasil Tes Terbaru</div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Sekolah</th>
                                <th>Kelas</th>
                                <th>Nilai</th>
                                <th>Waktu Tes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasilTesTerbaru as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->school }}</td>
                                <td>{{ $item->class }}</td>
                                <td>{{ $item->nilai }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ambil data dari Laravel (PHP)
    const dataSiswaBySekolah = {!! json_encode($totalSiswaBySekolah) !!};
    const dataSiswaByKelas = {!! json_encode($totalSiswaByKelas) !!};
    const dataRataBySekolah = {!! json_encode($rataNilaiBySekolah) !!};
    const dataRataByKelas = {!! json_encode($rataNilaiByKelas) !!};

    // 1. Siswa per Sekolah
    new Chart(document.getElementById('chartSiswaBySekolah'), {
        type: 'bar',
        data: {
            labels: dataSiswaBySekolah.map(item => item.school),
            datasets: [{
                label: 'Jumlah Siswa',
                data: dataSiswaBySekolah.map(item => item.total),
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        }
    });

    // 2. Siswa per Kelas
    new Chart(document.getElementById('chartSiswaByKelas'), {
        type: 'bar',
        data: {
            labels: dataSiswaByKelas.map(item => item.class),
            datasets: [{
                label: 'Jumlah Siswa',
                data: dataSiswaByKelas.map(item => item.total),
                backgroundColor: 'rgba(255, 99, 132, 0.7)'
            }]
        }
    });

    // 3. Status Tes
    new Chart(document.getElementById('chartTesStatus'), {
        type: 'pie',
        data: {
            labels: ['Sudah Tes', 'Belum Tes'],
            datasets: [{
                data: [{{ $siswaSudahTes }}, {{ $siswaBelumTes }}],
                backgroundColor: ['#4CAF50', '#FFC107']
            }]
        }
    });

    // 4. Rata-rata nilai per Sekolah
    new Chart(document.getElementById('chartRataNilaiBySekolah'), {
        type: 'bar',
        data: {
            labels: dataRataBySekolah.map(item => item.school),
            datasets: [{
                label: 'Rata-rata Nilai',
                data: dataRataBySekolah.map(item => parseFloat(item.rata_nilai)),
                backgroundColor: 'rgba(153, 102, 255, 0.7)'
            }]
        }
    });

    // 5. Rata-rata nilai per Kelas
    new Chart(document.getElementById('chartRataNilaiByKelas'), {
        type: 'bar',
        data: {
            labels: dataRataByKelas.map(item => item.class),
            datasets: [{
                label: 'Rata-rata Nilai',
                data: dataRataByKelas.map(item => parseFloat(item.rata_nilai)),
                backgroundColor: 'rgba(255, 159, 64, 0.7)'
            }]
        }
    });
</script>
@endsection
