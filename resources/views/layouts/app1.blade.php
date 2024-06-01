<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tugas Akhir</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76"
        href="{{ asset('black/src/black-stubs/resources/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('black/src/black-stubs/resources/assets/img/favicon.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('black/src/black-stubs/resources/assets/css/nucleo-icons.css') }}/" rel="stylesheet" />
    <!-- CSS -->
    <link href="{{ asset('black/src/black-stubs/resources/assets/css/black-dashboard.css?v=1.0.0') }}"
        rel="stylesheet" />
    <link href="{{ asset('black/src/black-stubs/resources/assets/css/theme.css') }}" rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }}">
    @auth()
        <div class="wrapper">
            @include('layouts.navbars.sidebar')
            <div class="main-panel">
                {{-- @include('layouts.navbars.navbar') --}}

                <div class="content">
                    @yield('content')
                </div>

                @include('layouts.footer')
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <div class="wrapper wrapper-full-page">
            @include('layouts.navbars.sidebar')
            <div class="main-panel">
                @include('layouts.navbars.navbar')
                <div class="content ">
                    @yield('contentgraph')
                </div>
                @include('layouts.footer')
            </div>
        </div>

        {{-- @include('layouts.navbars.navbar')

            <div class="wrapper wrapper-full-page">

                <div class="full-page {{ $contentClass ?? '' }}">
                    <div class="content">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.footer')
                </div>
            </div> --}}
    @endauth

    <script src="{{ asset('black/src/black-stubs/resources/assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('black/src/black-stubs/resources/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('black/src/black-stubs/resources/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('black/src/black-stubs/resources/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}">
    </script>
    <!--  Google Maps Plugin    -->
    <!-- Place this tag in your head or just before your close body tag. -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
    <!-- Chart JS -->
    <script src="{{ asset('black/src/black-stubs/resources/assets/js/plugins/chartjs.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('black/src/black-stubs/resources/assets/js/plugins/bootstrap-notify.js') }}"></script>

    <script src="{{ asset('black/src/black-stubs/resources/assets/js/black-dashboard.min.js?v=1.0.0') }}"></script>
    <script src="{{ asset('black/src/black-stubs/resources/assets/js/theme.js') }}"></script>
    <script>
        function createChart(chartId, labels, data, chartOption) {
            var ctx = document.getElementById(chartId).getContext('2d');
            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
            gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');

            var chartOption;

            // Tentukan opsi chart sesuai dengan chartId
            if (chartId === 'suhuChart') {
                chartOption = chartSuhuOption;
            } else if (chartId === 'phChart') {
                chartOption = chartPhOption;
            } else if (chartId === 'amoniaChart') {
                chartOption = chartAmoniaOption;
            } else if (chartId === 'saltChart') {
                chartOption = chartSaltOption;
            } else if (chartId === 'keruhChart') {
                chartOption = chartKeruhOption;
            }

            var newChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: chartId === 'suhuChart' ? 'Suhu' : (chartId === 'phChart' ? 'pH' : (
                            chartId === 'amoniaChart' ? 'Ammonia' :
                            (chartId === 'saltChart' ? 'TDS' : 'Kekeruhan'))),
                        data: data,
                        fill: true,
                        backgroundColor: gradientStroke,
                        borderColor: '#d048b6',
                        borderWidth: 2,
                        borderDash: [],
                        borderDashOffset: 0.0,
                        pointBackgroundColor: '#d048b6',
                        pointBorderColor: 'rgba(255,255,255,0)',
                        pointHoverBackgroundColor: '#d048b6',
                        pointBorderWidth: 20,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 15,
                        pointRadius: 4,
                    }]
                },
                options: chartOption
            });

            // Simpan chart ke dalam objek agar bisa diakses kembali
            charts[chartId] = newChart;
        }

        // Fungsi untuk menangani format waktu
        function extractTimeFromCreatedAt(created_at) {
            const dateTimeParts = created_at.split(' ');
            const timeOnly = dateTimeParts[1];
            return timeOnly;
        }

        // Objek untuk menyimpan chart agar bisa diakses kembali
        var charts = {};

        function updateChart(chartId, labels, data) {
            var chart = charts[chartId];
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }

        // Fungsi untuk mengambil data dari API dan memperbarui chart dengan filter
        function fetchDataAndDisplay(chartId, chartOption, selectedHub) {

            $.ajax({
                url: '/api/sensor-get',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(`Data ${chartId} - Filtered:`, data);
                    const latestData = data.slice(-10);
                    const labels = latestData.map(item => extractTimeFromCreatedAt(item.created_at));
                    const chartData = chartId === 'suhuChart' ? latestData.map(item => item.sensorsuhu) :
                        (chartId === 'phChart' ? latestData.map(item => item.sensorph) :
                            (chartId === 'amoniaChart' ? latestData.map(item => item.sensoramonia) :
                                (chartId === 'saltChart' ? latestData.map(item => item.sensortds) :
                                    latestData.map(item => item.sensorkekeruhan))));

                    // Panggil fungsi createChart tanpa variabel global
                    if (!charts[chartId]) {
                        createChart(chartId, labels, chartData, chartOption);
                    } else {
                        // Jika chart sudah ada, perbarui data chart
                        updateChart(chartId, labels, chartData);
                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });

        }



        // Fungsi untuk menerapkan filter
        setInterval(function applyfilter() {
            // Panggil fetchDataAndDisplay untuk setiap chart
            fetchDataAndDisplay('suhuChart');
            fetchDataAndDisplay('phChart');
            fetchDataAndDisplay('amoniaChart');
            fetchDataAndDisplay('saltChart');
            fetchDataAndDisplay('keruhChart');
        }, 5000);

        // Panggil fetchDataAndDisplay untuk menampilkan data awal pada saat halaman dimuat
        applyFilter();
    </script>



    @stack('js')

    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');
                $navbar = $('.navbar');
                $main_panel = $('.main-panel');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;
                white_color = false;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                $('.fixed-plugin a').click(function(event) {
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .background-color span').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data', new_color);
                    }

                    if ($main_panel.length != 0) {
                        $main_panel.attr('data', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data', new_color);
                    }
                });

                $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        sidebar_mini_active = false;
                        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                    } else {
                        $('body').addClass('sidebar-mini');
                        sidebar_mini_active = true;
                        blackDashboard.showSidebarMessage('Sidebar mini activated...');
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });

                $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (white_color == true) {
                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').removeClass('white-content');
                        }, 900);
                        white_color = false;
                    } else {
                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').addClass('white-content');
                        }, 900);

                        white_color = true;
                    }
                });
            });
        });
    </script>

    @stack('js')
</body>

</html>
