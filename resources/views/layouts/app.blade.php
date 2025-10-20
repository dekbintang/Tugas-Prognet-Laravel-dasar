<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Akademik')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: #f7f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Navbar soft */
        .navbar {
            background: linear-gradient(90deg, #a3cef1, #d4f1f9);
            border-radius: 0 0 12px 12px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }
        .navbar .nav-link, .navbar-brand {
            color: #2c3e50 !important;
            font-weight: 500;
        }
        .navbar .nav-link:hover {
            color: #1a5276 !important;
        }

        /* Card */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, #c1e1c1 0%, #e0f7e0 100%);
            color: #2c3e50;
            font-weight: 600;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        /* Tabel */
        table thead {
            background: #f0f4f8;
        }
        table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Tombol soft dan gradasi */
        .btn-success {
            background: linear-gradient(45deg, #a8e6cf, #dcedc1);
            border: none;
            color: #2c3e50;
        }
        .btn-warning {
            background: linear-gradient(45deg, #ffe0b2, #ffd180);
            border: none;
            color: #2c3e50;
        }
        .btn-danger {
            background: linear-gradient(45deg, #ffb3b3, #ff9999);
            border: none;
            color: #2c3e50;
        }
        .btn-primary {
            background: linear-gradient(45deg, #a0c4ff, #70a1ff);
            border: none;
            color: #fff;
        }
        .btn:hover {
            opacity: 0.85;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border: none;
        }

        /* Form */
        .form-control:focus {
            box-shadow: none;
            border-color: #7fb3d5;
        }
        label {
            font-weight: 500;
        }

        /* Alert */
        .alert {
            border-radius: 12px;
        }

        /* Pagination */
        .pagination .page-link {
            background: #fff;
            border: 1px solid #ddd;
            color: #1a5276;
        }
        .pagination .page-item.active .page-link {
            background: #1a5276;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-mortarboard-fill me-2"></i>Akademik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('mahasiswa.index') }}"><i class="bi bi-people-fill me-1"></i>Mahasiswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('prodi.index') }}"><i class="bi bi-book-fill me-1"></i>Prodi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('fakultas.index') }}"><i class="bi bi-building me-1"></i>Fakultas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
