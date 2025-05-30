<!DOCTYPE html>
<html>

<head>
    <title>Scrollable X-Axis Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css">

    {{-- public\bootstrap-5.0.2-dist\bootstrap-5.0.2-dist\css\bootstrap.min.css --}}
    <style>
        .outer-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .chart-container {
            width: 90%;
            overflow-x: auto;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }


        .chart-canvas {
            min-width: 1000px;
            /* Adjust based on number of x-axis labels */
        }

        .center-child {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="center">
        <div class="center-child">
            <h1>Sales & Report Chart</h1>
        </div>
    </div>
    <div class="outer-container">
        <div class="chart-container">
            <canvas id="salesReportChart" class="chart-canvas" height="200"></canvas>
        </div>
    </div>

    <div class="center">
        <div class="center-child">
            <h1>Pencapaian</h1>
        </div>
    </div>
    <div class="outer-container">
        <div class="chart-container">
            <canvas id="pencapaianChart" class="chart-canvas" height="200"></canvas>
        </div>
    </div>

    <div class="center">
        <div class="center-child">
            <h1>Bobot Sales & Report</h1>
        </div>
    </div>
    <div class="outer-container">
        <div class="chart-container">
            <canvas id="bobotChart" class="chart-canvas" height="200"></canvas>
        </div>
    </div>

    <div class="center">
        <div class="center-child">
            <h1>KPI</h1>
        </div>
    </div>
    <div class="outer-container">
        <div class="chart-container">
            <canvas id="kpiChart" class="chart-canvas" height="200"></canvas>
        </div>
    </div>

    <div class="center">
        <div class="center-child">
            <h1>Total Per Status</h1>
        </div>
    </div>
    <div class="outer-container">
        <div class="chart-container">
            <canvas id="totalPerStatusChart" class="chart-canvas" height="200"></canvas>
        </div>
    </div>

    <div class="center">
        <div class="center-child">
            <h1>Persentase Per Status</h1>
        </div>
    </div>
    <div class="outer-container">
        <div class="chart-container">
            <canvas id="persentasePerStatusChart" class="chart-canvas" height="200"></canvas>
        </div>
    </div>

    <script>
        console.log("{{ $data_total_per_status->total_ontime }}")
        var labels_kpi = @json($labels_kpi);
        var karyawan_name = @json($karyawan_name);

        var target_sales = @json($target_sales);
        var actual_sales = @json($actual_sales);
        var target_report = @json($target_report);
        var actual_report = @json($actual_report);

        var pencapaian_sales = @json($pencapaian_sales);
        var pencapaian_report = @json($pencapaian_report);

        var total_bobot_sales = @json($total_bobot_sales);
        var total_bobot_report = @json($total_bobot_report);

        var kpi = @json($kpi);

        const salesReportCtx = document.getElementById('salesReportChart').getContext('2d');
        const salesReportChart = new Chart(salesReportCtx, {
            type: 'line',
            data: {
                labels: karyawan_name,
                datasets: [{
                        label: 'Sales Target',
                        data: target_sales,
                        fill: false,
                        borderColor: '#007bff',
                        tension: 0.1
                    },
                    {
                        label: 'Actual Sales',
                        data: actual_sales,
                        fill: false,
                        borderColor: '#28a745',
                        tension: 0.1
                    },
                    {
                        label: 'Report Target',
                        data: target_report,
                        fill: false,
                        borderColor: '#6f42c1',
                        tension: 0.1
                    },
                    {
                        label: 'Actual Report',
                        data: actual_report,
                        fill: false,
                        borderColor: '#dc3545',
                        tension: 0.1
                    },
                ]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        grid: {
                            display: true
                        },
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: true
                        }
                    }
                }
            }
        });

        const pencapaianCtx = document.getElementById('pencapaianChart').getContext('2d');
        const pencapaianChart = new Chart(pencapaianCtx, {
            type: 'line',
            data: {
                labels: karyawan_name,
                datasets: [{
                        label: 'Pencapaian Sales',
                        data: pencapaian_sales,
                        fill: false,
                        borderColor: '#fd7e14',
                        tension: 0.1
                    },
                    {
                        label: 'Pencapaian Report',
                        data: pencapaian_report,
                        fill: false,
                        borderColor: '#ffc107',
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        grid: {
                            display: true
                        },
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: true
                        }
                    }
                }
            }
        });

        const bobotCtx = document.getElementById('bobotChart').getContext('2d');
        const bobotChart = new Chart(bobotCtx, {
            type: 'line',
            data: {
                labels: karyawan_name,
                datasets: [{
                        label: 'Total Bobot Sales',
                        data: total_bobot_sales,
                        fill: false,
                        borderColor: '#20c997',
                        tension: 0.1
                    },
                    {
                        label: 'Total Bobot Report',
                        data: total_bobot_report,
                        fill: false,
                        borderColor: '#6c757d',
                        tension: 0.1
                    },
                    {
                        label: 'KPI',
                        data: kpi,
                        fill: false,
                        borderColor: '#000000',
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        grid: {
                            display: true
                        },
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: true
                        }
                    }
                }
            }
        });

        const kpiCtx = document.getElementById('kpiChart').getContext('2d');
        const kpiChart = new Chart(kpiCtx, {
            type: 'line',
            data: {
                labels: karyawan_name,
                datasets: [{
                    label: 'KPI',
                    data: kpi,
                    fill: false,
                    borderColor: '#000000',
                    tension: 0.1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        grid: {
                            display: true
                        },
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: true
                        }
                    }
                }
            }
        });

        const totalPerStatusCtx = document.getElementById('totalPerStatusChart').getContext('2d');
        const totalPerStatusChart = new Chart(totalPerStatusCtx, {
            type: 'bar',
            data: {
                labels: ['Total Late', 'Total On-time'],
                datasets: [{
                    label: 'Total',
                    data: [
                        "{{ $data_total_per_status->total_late }}",
                        "{{ $data_total_per_status->total_ontime }}"
                    ],
                    fill: false,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        grid: {
                            display: false
                        },
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        const persentasePerStatusCtx = document.getElementById('persentasePerStatusChart').getContext('2d');
        const persentasePerStatusChart = new Chart(persentasePerStatusCtx, {
            type: 'pie',
            data: {
                labels: ['Late', 'On-time'],
                datasets: [{
                    label: 'Persentase',
                    data: [
                        "{{ $data_total_per_status->late_percentage }}",
                        "{{ $data_total_per_status->ontime_percentage }}"
                    ],
                    fill: false,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                        },
                    }],
                }
            }
        });
    </script>
</body>

</html>
