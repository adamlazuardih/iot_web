@extends('layouts.app1', ['pageSlug' => 'graph'])

@section('contentgraph')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hub
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-hub="all">Semua Hub</a>
                                    <a class="dropdown-item" href="#" data-hub="Hub1">Hub1</a>
                                    <a class="dropdown-item" href="#" data-hub="Hub2">Hub2</a>
                                    <a class="dropdown-item" href="#" data-hub="Hub3">Hub3</a>
                                </div>
                            </div>



                            <h3 class="card-title">
                                <center>Sensor Grafik Suhu(°C)</center>
                                </h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="suhuChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-title">
                                <center>Sensor Grafik PH</center>
                                </h2>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="phChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-title">
                                <center>Sensor Grafik Amonia</center>
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="amoniaChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-title">
                                <center>Sensor Grafik Salinitas</center>
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="saltChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-title">
                                <center>Sensor Grafik Kekeruhan</center>
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="keruhChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('js')
    {{-- <script src="{{ asset('black/src/black-stubs/resources/assets/js/plugins/chartjs.min.js') }}"></script> --}}
    <script src="{{ asset('black/src/black-stubs/resources/assets/js/black-dashboard.js') }}"></script>
    <script>
        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script>
@endpush
