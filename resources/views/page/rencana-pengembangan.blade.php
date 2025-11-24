<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lembaga Penjaminan Mutu Universitas Global Jakarta">
    <meta name="keywords" content="LPM JGU">
    <meta name="author" content="itic">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} - Lembaga Penjaminan Mutu Jakarta Global University</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    @include('layouts.css')
    @yield('style')
    <style>
    .chart-container {
        width: 100%;
        margin: 10px 0 0;
    }

    .chart-card {
        border: none;
        border-radius: 18px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
    }

    .chart-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.15);
    }

    .year-filter-btn.active {
        background-color: #2563eb !important;
        color: white !important;
        border-color: #2563eb !important;
    }

    .year-filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .evidence-btn {
        border-radius: 999px;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .evidence-btn:hover {
        transform: translateY(-1px);
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .chart-container {
            height: 300px !important;
        }
    }

    .page-wrapper.compact-wrapper .nav-right .nav-menus {
        margin-right: 0px;
    }

    .dropdown-basic .dropdown .dropdown-content a {
        padding: 16px 16px;
    }

    .landing-home .content {
        text-align: left;
        margin-left: 20px;
    }
    .table-sm th, .table-sm td {
        padding: 0px;
    }
    </style>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="landing-page">
    <div class="loader-wrapper">
        <div class="loader-index">
            <span></span>
        </div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></fecolormatrix>
            </filter>
        </svg>
    </div>
    <div class="tap-top">
        <i data-feather="chevrons-up"></i>
    </div>
    <div class="page-wrapper landing-page">
        <div class="landing-home">
            <ul class="decoration">
                <li class="one">
                    <img class="img-fluid" src="{{ asset('assets/images/landing/decore/1.png') }}" alt="">
                </li>
                <li class="two">
                    <img class="img-fluid" src="{{ asset('assets/images/landing/decore/2.png') }}" alt="">
                </li>
                <li class="three">
                    <img class="img-fluid" src="{{ asset('assets/images/landing/decore/4.png') }}" alt="">
                </li>
                <li class="four">
                    <img class="img-fluid" src="{{ asset('assets/images/landing/decore/3.png') }}" alt="">
                </li>
                <li class="five">
                    <img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}" alt="">
                </li>
                <li class="six">
                    <img class="img-fluid" src="{{ asset('assets/images/landing/decore/cloud.png') }}" alt="">
                </li>
                <li class="seven">
                    <img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}" alt="">
                </li>
            </ul>
            <div class="container-fluid">
                <div class="sticky-header">
                    <header>
                        <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding" id="sidebar-menu">
                            <a class="navbar-brand p-0" href="{{ route('index') }}">
                                <img class="img-fluid" src="{{ asset('assets/images/logo-white.png') }}" alt="JGU">
                            </a>
                            <button class="navbar-toggler navabr_btn-set custom_nav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <div class="navbar-collapse justify-content-end collapse hidenav" id="navbarDefault"></div>
                        </nav>
                    </header>
                </div>
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="content ">
                            <div class="container">
                                <h1 class="wow fadeIn h-50">Rencana Pengembangan</h1>
                                <h2 class="txt-secondary wow fadeIn">Jakarta Global University</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="wow fadeIn">
                            <img class="screen2" style="margin-top: 10vh;" src="{{ asset('assets/images/landing/screen2.jpg') }}" alt="" draggable="false">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-space cuba-demo-section components-section" id="results">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Dashboard</h2>
                            </div>
                            <p>Rencana Pengembangan 5 Tahun Universitas Global Jakarta</p>
                        </div>
                        <p class="lead text-muted mb-0">Periode <span id="year-range-display">2020 - 2025</span></p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center py-5">
                <div class="col-12 col-xl-10">

                    <div class="card border-0 mb-4">
                        <div class="card-body d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                            <div class="text-start">
                                <h3 class="h5 fw-semibold text-secondary mb-1">Filter Tahun Akademik</h3>
                                <p class="mb-0 text-muted">Pilih rentang tahun untuk melihat detail indikator.</p>
                            </div>
                            <div class="btn-group flex-wrap" role="group" aria-label="Filter Tahun Akademik" id="year-filter-buttons">
                                @foreach($years as $yearOption)
                                    <button onclick="filterByYear('{{ $yearOption }}')" class="year-filter-btn btn btn-outline-primary {{ $yearOption == $selectedYear ? 'active btn-primary' : '' }}">
                                        {{ $yearOption }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="dashboard-container" class="row g-4">
                        <!-- Cards generated by JavaScript -->
                    </div>
                </div>
            </div>
        </section>

        <footer class="section-space bg-secondary py-1">
            <hr>
            <span>
                Copyright © {{ (date('Y')=="2022"?date('Y'):"2022-".date('Y')) }} made with ❤️ by <a href="https://itic.jgu.ac.id" target="_blank">ITIC JGU</a>.
                <br>
                <small class="ml-4 text-center text-sm text-light sm:text-right sm:ml-0">
                    v{{ Illuminate\Foundation\Application::VERSION }}p{{ PHP_VERSION }} - All rights reserved.
                </small>
            </span>
        </footer>
    </div>
    
    <script>
    // Data Rencana Pengembangan dari backend
    const developmentData = @json($plans);
    const availableYears = @json($years);
    let currentYear = "{{ $selectedYear }}";

    const chartVariantMapping = {
        'Jumlah Mahasiswa': 'column',
        'Kualitas Pendidikan': 'combo',
        'Hubungan Industri': 'bar',
        'Kewirausahaan': 'column',
        'Internasionalisasi': 'combo',
        'Riset': 'bar',
        'Pengalaman belajar': 'column',
        'Pengembangan teknologi dan informasi kampus': 'combo',
        'Keberlanjutan': 'bar',
        'Reputasi dan Branding': 'column'
    };

    let singleChartModeMap = {};

    // Load Google Charts
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(() => {
        // Set initial year range display
        if (availableYears.length > 0) {
            const minYear = availableYears[0].split('/')[0];
            const maxYear = availableYears[availableYears.length - 1].split('/')[1];
            document.getElementById('year-range-display').textContent = `${minYear} - ${maxYear}`;
        }
        renderDashboard(currentYear);
    });

    // Filter by year
    function filterByYear(year) {
        currentYear = year;
        
        // Update URL to reflect selected year
        const url = new URL(window.location.href);
        url.searchParams.set('year', year);
        window.history.pushState({}, '', url);

        // Update button styles
        document.querySelectorAll('.year-filter-btn').forEach(btn => {
            btn.classList.remove('active', 'btn-primary');
            btn.classList.add('btn-outline-primary');
            if (btn.textContent.trim() === year) {
                btn.classList.remove('btn-outline-primary');
                btn.classList.add('active', 'btn-primary');
            }
        });
        
        renderDashboard(year);
    }

    // Initialize first button as active (no longer needed, handled by Blade)
    // document.addEventListener('DOMContentLoaded', function() {
    //     const firstButton = document.querySelector('.year-filter-btn');
    //     if (firstButton) {
    //         firstButton.classList.remove('btn-outline-primary');
    //         firstButton.classList.add('active', 'btn-primary');
    //     }
    // });

    // Render dashboard
    function renderDashboard(year) {
        const container = document.getElementById('dashboard-container');
        container.innerHTML = '';
        
        const yearData = developmentData[year];
        if (!yearData) {
            container.innerHTML = '<div class="col-12"><p class="text-muted text-center">Tidak ada data untuk tahun akademik ini.</p></div>';
            return;
        }

        let priorityNumber = 1;
        singleChartModeMap = {};
        let pieModeToggle = true;
        
        for (const [priority, items] of Object.entries(yearData)) {
            const chartVariant = getChartVariant(priorityNumber, priority);
            let singleChartMode = null;
            if (items.length === 1) {
                singleChartMode = pieModeToggle ? 'donut' : 'pie';
                singleChartModeMap[priorityNumber] = singleChartMode;
                pieModeToggle = !pieModeToggle;
            }
            const card = createCard(priority, items, priorityNumber, year, chartVariant, singleChartMode);
            container.appendChild(card);
            priorityNumber++;
        }
        
        // Draw all charts after DOM is ready
        setTimeout(() => {
            priorityNumber = 1;
            for (const [priority, items] of Object.entries(yearData)) {
                const chartVariant = getChartVariant(priorityNumber, priority);
                if (items.length === 1) {
                    const pieMode = singleChartModeMap[priorityNumber] || 'donut';
                    drawPieChart(priority, items[0], priorityNumber, pieMode);
                } else {
                    drawComparisonChart(priority, items, priorityNumber, chartVariant);
                }
                priorityNumber++;
            }
        }, 100);
    }

    function getChartVariant(priorityNumber, priority) {
        if (chartVariantMapping[priority]) {
            return chartVariantMapping[priority];
        }
        if (priorityNumber % 3 === 0) return 'combo';
        return priorityNumber % 2 === 0 ? 'column' : 'bar';
    }

    function getVariantBadge(variant) {
        switch (variant) {
            case 'combo': return '<span class="badge bg-info-subtle text-info fw-semibold">Combo Chart</span>';
            case 'column': return '<span class="badge bg-primary-subtle text-primary fw-semibold">Column Chart</span>';
            case 'bar': return '<span class="badge bg-success-subtle text-success fw-semibold">Bar Chart</span>';
            default: return ''; // Should not happen with defined variants
        }
    }

    // Create card element
    function createCard(priority, items, priorityNumber, year, variant, singleChartMode) {
        const col = document.createElement('div');
        col.className = 'col-12 col-lg-6';
        col.id = `card-${priorityNumber}`;
        
        const chartId = `chart-${priorityNumber}`;
        // --- Variant Badge disabled, add ${variantBadge} below </div> to add it ---
        const variantBadge = items.length === 1
            ? (singleChartMode === 'pie'
                ? '<span class="badge bg-warning-subtle text-warning fw-semibold">Pie Chart</span>'
                : '<span class="badge bg-warning-subtle text-warning fw-semibold">Donut Chart</span>')
            : getVariantBadge(variant);
        const evidenceButtons = renderEvidenceButtons(items, priority, year, priorityNumber);
        
        col.innerHTML = `
            <div class="card chart-card h-100">
                <div class="card-body">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-3 gap-2">
                        <div class="text-start">
                            <p class="text-muted small mb-1">Prioritas ${priorityNumber}</p>
                            <h3 class="h5 fw-bold mb-0 text-dark">${priority}</h3>
                            <small class="text-secondary">Tahun Akademik: ${year}</small>
                        </div>
                        
                    </div>
                    <div id="${chartId}" class="chart-container" style="height: ${items.length === 1 ? '340px' : '360px'};"></div>
                    <div id="non-numeric-info-${priorityNumber}"></div>
                    <div id="pie-chart-details-${priorityNumber}"></div> <!-- New div for details -->
                    ${evidenceButtons}
                </div>
            </div>
        `;
        
        return col;
    }

    function renderEvidenceButtons(items, priority, year, priorityNumber) {
        if (!items || !items.length) return '';
        const buttons = items.map((item, index) => {
            const label = item.uraian ? item.uraian.replace(/"/g, '&quot;') : `Indikator ${index + 1}`;
            const link = item.link ? item.link : '#';
            return `
                <a href="${link}" class="btn btn-sm btn-outline-secondary evidence-btn" target="_blank" rel="noopener" aria-label="Unduh eviden untuk ${label}" title="Unduh eviden: ${label}">
                    Unduh Eviden
                </a>
            `;
        }).join('');
        return `<div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">${buttons}</div>`;
    }

    // Draw Pie Chart (for single uraian)
    function drawPieChart(priority, item, priorityNumber, mode = 'donut') {
        const chartId = `chart-${priorityNumber}`;
        const chartDiv = document.getElementById(chartId);
        const detailsContainer = document.getElementById(`pie-chart-details-${priorityNumber}`);
        const nonNumericInfoContainer = document.getElementById(`non-numeric-info-${priorityNumber}`);

        if (!chartDiv || !detailsContainer || !nonNumericInfoContainer) return;

        let rencanaVal = 0;
        let tercapaiVal = 0;
        let isNumeric = false;

        const parsedRencana = parseFloat(item.rencana);
        const parsedTercapai = parseFloat(item.tercapai);

        if (!isNaN(parsedRencana) && !isNaN(parsedTercapai)) {
            rencanaVal = parsedRencana;
            tercapaiVal = parsedTercapai;
            isNumeric = true;
        }

        // --- Display values below the chart ---
        let displayPercentage = 0;
        if (rencanaVal !== 0) {
            displayPercentage = (tercapaiVal / rencanaVal) * 100;
        } else if (tercapaiVal > 0) {
            displayPercentage = 100;
        }
        const formattedDisplayPercentage = displayPercentage > 100 ? 100 : displayPercentage.toFixed(2);

        detailsContainer.innerHTML = `
            <div class="mt-4 pt-4 border-top">
                <p class="mb-0 fw-semibold text-dark">Rencana: ${Math.round(rencanaVal)}</p>
                <p class="mb-0 fw-bold text-dark">Target Tercapai: ${Math.round(tercapaiVal)} (${formattedDisplayPercentage}%)</p>
            </div>
        `;
        // --- End display values below the chart ---

        // --- Chart rendering logic ---
        if (!isNumeric) {
            chartDiv.style.display = 'none';
            nonNumericInfoContainer.innerHTML = `
                <div class="mt-4 mb-3 pb-3 border-bottom">
                    <p class="mb-0 fw-semibold text-dark">${item.uraian}</p>
                    <p class="mb-0 fw-bold text-primary fs-5">${item.rencana}</p>
                </div>
            `;
            return;
        }

        chartDiv.style.display = 'block';

        let chartTercapai = Math.round(Math.max(0, tercapaiVal));
        let chartRencana = Math.round(Math.max(0, rencanaVal));

        if (chartRencana === 0) {
            if (chartTercapai === 0) {
                chartTercapai = 0;
                chartRencana = 1;
            } else {
                chartTercapai = 1;
                chartRencana = 1;
            }
        }
        
        let displayInChartTercapai = Math.min(chartTercapai, chartRencana);
        let displayInChartRemaining = Math.max(0, chartRencana - displayInChartTercapai);


        const data = google.visualization.arrayToDataTable([
            ['Kategori', 'Nilai'],
            ['Target Tercapai', displayInChartTercapai],
            ['Sisa Target', displayInChartRemaining]
        ]);
        
        const options = {
            title: item.uraian,
            titleTextStyle: {
                fontSize: 14,
                bold: true
            },
            pieHole: mode === 'donut' ? 0.45 : 0,
            colors: ['#2ecc71', '#f0f0f0'],
            legend: {
                position: 'bottom',
                textStyle: { fontSize: 12 }
            },
            pieSliceText: 'percentage',
            pieSliceTextStyle: {
                fontSize: 14,
                bold: true
            },
            tooltip: {
                textStyle: { fontSize: 12 }
            }
        };
        
        const chart = new google.visualization.PieChart(chartDiv);
        chart.draw(data, options);
    }

    // Draw Comparison Chart (for multiple uraian)
    function drawComparisonChart(priority, items, priorityNumber, variant) {
        const chartId = `chart-${priorityNumber}`;
        const chartDiv = document.getElementById(chartId);
        
        if (!chartDiv) return;
        
        // Separate numeric and non-numeric items
        const numericItems = items.filter(item => {
            return (typeof item.rencana === 'number' || 
                   (typeof item.rencana === 'string' && !isNaN(parseFloat(item.rencana)) && item.rencana.trim() !== '')) &&
                   (typeof item.tercapai === 'number' || 
                   (typeof item.tercapai === 'string' && !isNaN(parseFloat(item.tercapai)) && item.tercapai.trim() !== ''));
        });
        const nonNumericItems = items.filter(item => {
            return !((typeof item.rencana === 'number' || 
                    (typeof item.rencana === 'string' && !isNaN(parseFloat(item.rencana)) && item.rencana.trim() !== '')) &&
                    (typeof item.tercapai === 'number' || 
                    (typeof item.tercapai === 'string' && !isNaN(parseFloat(item.tercapai)) && item.tercapai.trim() !== '')));
        });
        
        // Prepare data - only include numeric values for chart
        const dataArray = [['Uraian', 'Rencana', 'Target Tercapai']];
        
        numericItems.forEach(item => {
            // Handle numeric values
            let rencana = 0;
            let tercapai = 0;
            
            if (typeof item.rencana === 'number') {
                rencana = item.rencana;
            } else if (typeof item.rencana === 'string' && !isNaN(parseFloat(item.rencana))) {
                rencana = parseFloat(item.rencana);
            }
            
            if (typeof item.tercapai === 'number') {
                tercapai = item.tercapai;
            } else if (typeof item.tercapai === 'string' && !isNaN(parseFloat(item.tercapai))) {
                tercapai = parseFloat(item.tercapai);
            }
            
            // Shorten uraian if too long
            let uraianLabel = item.uraian;
            if (uraianLabel && uraianLabel.length > 37) {
                uraianLabel = uraianLabel.substring(0, 37) + '...';
            }
            
            dataArray.push([uraianLabel, rencana, tercapai]);
        });
        
        // Only draw chart if there are numeric items
        if (numericItems.length === 0) {
            chartDiv.innerHTML = '<p class="text-muted text-center p-4">Tidak ada data numerik untuk ditampilkan dalam chart.</p>';
            chartDiv.style.minHeight = '150px'; // Ensure some height even with no chart
        } else {
            const data = google.visualization.arrayToDataTable(dataArray);
            
            // Calculate max value for better scaling (only from numeric items)
            let maxValue = 0;
            numericItems.forEach(item => {
                const rencana = typeof item.rencana === 'number' ? item.rencana : 
                               (typeof item.rencana === 'string' && !isNaN(parseFloat(item.rencana)) ? parseFloat(item.rencana) : 0);
                const tercapai = typeof item.tercapai === 'number' ? item.tercapai : 
                               (typeof item.tercapai === 'string' && !isNaN(parseFloat(item.tercapai)) ? parseFloat(item.tercapai) : 0);
                maxValue = Math.max(maxValue, rencana, tercapai);
            });
        
            const isBar = variant === 'bar';
            const isCombo = variant === 'combo';
            
            const options = {
                title: priority,
                titleTextStyle: {
                    fontSize: 16,
                    bold: true
                },
                colors: ['#0d6efd', '#20c997'],
                legend: {
                    position: 'top',
                    textStyle: { fontSize: 12 }
                },
                chartArea: {
                    left: isBar ? 160 : 60,
                    top: 70,
                    width: isBar ? '60%' : '80%',
                    height: '60%'
                },
                bar: {
                    groupWidth: '55%'
                },
                tooltip: {
                    textStyle: { fontSize: 12 }
                }
            };

            if (isBar) {
                options.hAxis = {
                    title: 'Nilai',
                    minValue: 0,
                    maxValue: maxValue > 0 ? maxValue * 1.2 : 100,
                    textStyle: { fontSize: 11 }
                };
                options.vAxis = {
                    title: 'Uraian',
                    textStyle: { fontSize: 10 }
                };
            } else {
                options.vAxis = {
                    title: 'Nilai',
                    minValue: 0,
                    maxValue: maxValue > 0 ? maxValue * 1.2 : 100,
                    textStyle: { fontSize: 11 }
                };
                options.hAxis = {
                    title: 'Uraian',
                    slantedText: true,
                    slantedTextAngle: 20,
                    textStyle: { fontSize: 10 }
                };
            }
            
            if (isCombo) {
                options.seriesType = 'bars';
                options.series = {
                    1: { type: 'line', curveType: 'function', lineWidth: 3, pointSize: 6, color: '#6f42c1' }
                };
            }
            
            let chart;
            if (isCombo) {
                chart = new google.visualization.ComboChart(chartDiv);
            } else if (isBar) {
                chart = new google.visualization.BarChart(chartDiv);
            } else {
                chart = new google.visualization.ColumnChart(chartDiv);
            }
            chart.draw(data, options);
        }
        
        // Add text info for non-numeric items below chart with better formatting: Akreditasi Institusi
        if (nonNumericItems.length > 0) {
            const infoContainer = document.getElementById(`non-numeric-info-${priorityNumber}`);
            if (infoContainer) {
                let infoHTML = '';
                nonNumericItems.forEach(item => {
                    infoHTML += `
                        <div class="mt-4 pt-4 pb-2 border-top">
                            <p class="mb-0 fw-semibold text-dark">${item.uraian}</p>
                            <p class="mb-0 fw-bold text-primary fs-5">${item.rencana}</p>
                        </div>
                    `;
                });
                infoContainer.innerHTML = infoHTML;
            }
        }
    }
    </script>

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    @yield('script')

    @if (Route::current()->getName() != 'popover')
        <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    @endif
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/script2.js') }}"></script>
</body>
</html>
