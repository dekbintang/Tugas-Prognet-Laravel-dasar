<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Mahasiswa')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%);
            min-height: 100vh;
        }
        .gold-btn {
            background-color: #d4af37;
            color: white;
        }
        .gold-btn:hover {
            background-color: #c9a131;
        }
    </style>
</head>
<body class="text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-gradient-to-r from-blue-900 to-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wide">🎓 Sistem Mahasiswa</h1>
            <div>
                <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 hover:underline">Home</a>
                <a href="{{ route('mahasiswa.create') }}" class="px-4 py-2 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-100 transition">Tambah</a>
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <div class="max-w-6xl mx-auto mt-10">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center mt-20 py-6 text-gray-500 border-t">
        © {{ date('Y') }} Sistem Mahasiswa | Designed with 💙 by Laravel
    </footer>

</body>
</html>
