<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Akademik')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }
        .navbar-brand {
            font-weight: 600;
            color: #212529 !important;
        }
        .nav-link {
            color: #212529 !important;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-link:hover {
            color: #6c757d !important;
        }
        .card {
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }
        .btn-primary {
            background-color: #212529;
            border-color: #212529;
        }
        .btn-primary:hover {
            background-color: #343a40;
        }
        .btn-light {
            border: 1px solid #ced4da;
        }
        footer {
            border-top: 1px solid #dee2e6;
            padding: 15px 0;
            color: #6c757d;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4 shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <i class="bi bi-mortarboard-fill me-2"></i> Dashboard Akademik
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto fw-medium">
        <li class="nav-item">
          <a href="{{ route('mahasiswa.index') }}" class="nav-link">
            <i class="bi bi-person-lines-fill"></i> Mahasiswa
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('prodi.index') }}" class="nav-link">
            <i class="bi bi-journal-text"></i> Prodi
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('fakultas.index') }}" class="nav-link">
            <i class="bi bi-building"></i> Fakultas
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mb-5">
    @yield('content')
</div>

<footer>
  <small><i class=""></i>Sistem Akademik</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
