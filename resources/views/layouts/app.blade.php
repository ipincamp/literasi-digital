<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Literasi Sains Sekolah Dasar</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


    <!-- Styles & Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        #app {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            width: 220px;
            position: fixed;
            top: 56px;
            left: 0;
            height: 100%;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            padding-top: 20px;
            z-index: 1000;
        }

        .main-content {
            flex: 1;
            margin-left: 220px;
            padding: 80px 20px 20px;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 10px 15px;
        }

        .sidebar .nav-link:hover {
            background-color: #e2e6ea;
            border-radius: 5px;
            text-decoration: none;
        }

        footer {
            margin-left: 220px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                top: 0;
                border-right: none;
            }

            .main-content {
                margin-left: 0;
                padding-top: 80px;
            }

            footer {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- HEADER -->
        <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow-sm">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Literasi Sains SD
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="bi bi-person-lines-fill me-1"></i> Lihat Profil
                                </a>
                                <a class="dropdown-item" href="{{ route('password.change') }}">
                                    <i class="bi bi-key-fill me-1"></i> Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- SIDEBAR -->
@auth
<div class="sidebar">
    <ul class="nav flex-column">

        <!-- Dashboard - selalu ditampilkan -->
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}"><i class="bi bi-house-door-fill me-2"></i> Dashboard</a>
        </li>

        @if(auth()->user()->level == 1)
            <!-- Hanya untuk Admin -->

            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin') }}"><i class="bi bi-person-badge-fill me-2"></i> Data Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('siswa') }}"><i class="bi bi-people-fill me-2"></i> Manajemen Siswa</a>
            </li>

            <!-- Master Soal -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#masterSoalMenu" role="button" aria-expanded="false" aria-controls="masterSoalMenu">
                    <i class="bi bi-journal-text me-2"></i> Master Soal
                    <i class="bi bi-chevron-down float-end"></i>
                </a>
                <ul class="nav flex-column collapse ms-3" id="masterSoalMenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('soal') }}">Soal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('domain-kognitif') }}">Domain Kognitif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('indikator-literasi') }}">Indikator Literasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('teslet') }}">Teslet</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('nilai') }}"><i class="bi bi-bar-chart-fill me-2"></i> Nilai Tes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('petunjuk') }}"><i class="bi bi-info-circle-fill me-2"></i> Petunjuk</a>
            </li>

        @elseif(auth()->user()->level == 2)
            <!-- Untuk Siswa -->

            <li class="nav-item">
                <a class="nav-link" href="{{ url('ujian') }}"><i class="bi bi-pencil-fill me-2"></i> Ujian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('nilai') }}"><i class="bi bi-bar-chart-fill me-2"></i> Hasil Ujian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('petunjuk') }}"><i class="bi bi-info-circle-fill me-2"></i> Petunjuk</a>
            </li>
        @endif

    </ul>
</div>
@endauth


<!-- MAIN CONTENT -->
<main class="main-content">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="text-center py-3 border-top bg-light">
    <small>&copy; {{ date('Y') }} Literasi Sains SD. All rights reserved.</small>
</footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@stack('scripts')
</body>
</html>
