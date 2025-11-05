@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-speedometer2"></i> Dashboard</h4>
    <span class="text-muted">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}</span>
</div>

<div class="row g-3">
    {{-- Kartu Statistik --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center py-2">
                <div>
                    <h6 class="text-muted mb-1">Mahasiswa</h6>
                    <h4 class="fw-bold mb-0">{{ $jumlahMahasiswa ?? 0 }}</h4>
                </div>
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-people fs-5"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center py-2">
                <div>
                    <h6 class="text-muted mb-1">Prodi</h6>
                    <h4 class="fw-bold mb-0">{{ $jumlahProdi ?? 0 }}</h4>
                </div>
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-journal-bookmark fs-5"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center py-2">
                <div>
                    <h6 class="text-muted mb-1">Fakultas</h6>
                    <h4 class="fw-bold mb-0">{{ $jumlahFakultas ?? 0 }}</h4>
                </div>
                <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-building fs-5"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Grafik Statistik --}}
<div class="card mt-4 shadow-sm border-0" style="max-width: 400px; margin: 40px auto;">
    <div class="card-header bg-white text-center">
        <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Data</h6>
    </div>
    <div class="card-body p-2">
        <canvas id="chartStatistik" width="400" height="250"></canvas>
    </div>
</div>

{{-- Navigasi Cepat --}}
<div class="mt-4">
    <h6 class="mb-2"><i class="bi bi-lightning"></i> Akses Cepat</h6>
    <div class="row g-2">
        <div class="col-md-4">
            <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm hover-shadow">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-person-lines-fill text-primary fs-3"></i>
                        <div class="mt-1">Mahasiswa</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('prodi.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm hover-shadow">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-book text-success fs-3"></i>
                        <div class="mt-1">Prodi</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('fakultas.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm hover-shadow">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-bank text-warning fs-3"></i>
                        <div class="mt-1">Fakultas</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('chartStatistik').getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mahasiswa', 'Prodi', 'Fakultas'],
                datasets: [{
                    label: 'Jumlah Data',
                    data: {!! json_encode([$jumlahMahasiswa ?? 0, $jumlahProdi ?? 0, $jumlahFakultas ?? 0]) !!},
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // biar canvas sesuai ukuran div
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }
});
</script>
@endpush