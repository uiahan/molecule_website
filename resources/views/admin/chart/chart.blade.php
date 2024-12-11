@extends('layout.master')
@section('title', 'Grafik')
@section('content')
    <div class="d-flex">
        @include('components.sidebar')
        <div class="container mt-4 mt-md-5 py-5">
            <div class="p-4 shadow card border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="fw-bold text-secondary">Grafik</h3>
                    </div>
                    <div class="col-6">
                        <p class="text-muted text-end text-secondary">Grafik &gt; Home</p>
                    </div>
                </div>
            </div>

            <div class="p-4 shadow card border-0 mt-4 chart-card">
                <h4 class="fw-bold text-center">Grafik Pendaftaran (Scan)</h4>
                <canvas id="scanChart" width="500" height="500"></canvas> <!-- Set smaller width and height -->
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('scanChart').getContext('2d');
        const scanChart = new Chart(ctx, {
            type: 'pie', // Pie chart type
            data: {
                labels: ['Belum Scan', 'Sudah Scan'],
                datasets: [{
                    label: 'Jumlah Registrasi',
                    data: [{{ $data['belum_scan'] }}, {{ $data['sudah_scan'] }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', // Color for 'Belum Scan'
                        'rgba(54, 162, 235, 0.6)'  // Color for 'Sudah Scan'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection

<style>
    .chart-card {
        /* Keep the card size unchanged */
        /* Optional: Add padding if needed */
    }

    /* Optional: Center the chart if desired */
    #scanChart {
        display: block;
        margin: 0 auto; /* Center the chart */
    }
</style>
