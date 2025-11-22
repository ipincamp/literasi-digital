<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="192x192" href="https://unnes.ac.id/lppm/wp-content/uploads/sites/16/2015/08/Logo-Transparan-Warna-1.png">
    <title>Beranda - Tes Literasi Sains SD</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            background-color: #f3f9ff;
            color: #003E5A;
            line-height: 1.6;
        }
        header {
            background-color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        header h1 {
            font-size: 1.6rem;
            color: #007ACC;
        }
        nav a {
            margin-left: 1rem;
            color: #003E5A;
            text-decoration: none;
            font-weight: bold;
        }
        .hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .hero-text {
            flex: 1 1 500px;
            padding-right: 2rem;
        }
        .hero-text h2 {
            font-size: 2.5rem;
            color: #003E5A;
            margin-bottom: 1rem;
        }
        .hero-text p {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 2rem;
        }
        .hero-text button {
            padding: 0.75rem 1.5rem;
            background-color: #007ACC;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        .hero-text button:hover {
            background-color: #005f9e;
        }
        .hero-image {
            flex: 1 1 400px;
            text-align: center;
        }
        .hero-image img {
            max-width: 100%;
            height: auto;
        }
        .features, .petunjuk {
            background-color: #ffffff;
            padding: 4rem 2rem;
            text-align: center;
        }
        .features h3,
        .petunjuk h3 {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: #003E5A;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }
        .feature {
            background-color: #e9f4ff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .feature h4 {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            color: #007ACC;
        }
        .feature p {
            font-size: 0.95rem;
            color: #333;
        }
        .petunjuk-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: left;
            font-size: 1rem;
            color: #333;
            background-color: #f0f8ff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        footer {
            text-align: center;
            padding: 2rem;
            background-color: #003E5A;
            color: #fff;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<header>
    <h1>Literasi Sains SD</h1>
    <nav>
        <a href="#">Beranda</a>
        <a href="#fitur">Fitur</a>
        <a href="#petunjuk">Petunjuk</a>
        <a href="#kontak">Kontak</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <h2>Selamat Datang di Aplikasi Tes Literasi Sains</h2>
        <p>Platform interaktif untuk siswa SD yang dirancang untuk mengasah kemampuan berpikir kritis dan pemahaman konsep sains melalui soal-soal kontekstual yang menyenangkan dan menantang.</p>
        <button onclick="window.location.href='{{ route('login') }}'">Mulai Tes Sekarang</button>
    </div>
    <div class="hero-image">
        <img src="{{ asset('image/banner.jpg') }}" alt="Ilustrasi Siswa Belajar Sains">
    </div>
</section>

<section class="features" id="fitur">
    <h3>Fitur Unggulan</h3>
    <div class="feature-grid">
        <div class="feature">
            <h4>Soal Kontekstual</h4>
            <p>Dikembangkan sesuai kehidupan sehari-hari agar siswa mudah memahami konsep sains.</p>
        </div>
        <div class="feature">
            <h4>Analisis Hasil</h4>
            <p>Siswa dan guru dapat melihat hasil tes untuk mengetahui area kekuatan dan kelemahan.</p>
        </div>
        <div class="feature">
            <h4>Visual Menarik</h4>
            <p>Tampilan visual yang disesuaikan dengan karakter anak SD agar lebih semangat belajar.</p>
        </div>
        <div class="feature">
            <h4>Akses Mudah</h4>
            <p>Dapat digunakan di berbagai perangkat tanpa perlu instalasi aplikasi tambahan.</p>
        </div>
    </div>
</section>

<section class="petunjuk" id="petunjuk">
    <h3>Petunjuk Tes</h3>
    <div class="petunjuk-content">
        @php
            $petunjuk = DB::table('petunjuk')->first();
        @endphp

        {!! $petunjuk->petunjuk ?? '<p>Petunjuk belum tersedia.</p>' !!}
    </div>
</section>

<footer id="kontak">
    &copy; 2025 Literasi Sains Indonesia — Dikembangkan untuk anak Indonesia yang cerdas dan kritis.
</footer>
</body>
</html>
