@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('contentdashboard')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">

                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h3 class="card-title">
                                <center>Suhu °C</center>
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <h1 class="card-title bigger">
                                    <center id="suhuRealtime">Wait..</center>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-chart">

                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h3 class="card-title">
                                <center>pH</center>
                                {{-- <center>pH</center> --}}
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <h1 class="card-title bigger">
                                    <center id="phRealtime">Wait..</center>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-chart">

                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h3 class="card-title">
                                <center>Salinitas</center>
                                {{-- <center>TDS</center> --}}
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <h1 class="card-title bigger">
                                    <center id="tdsRealtime">Wait..</center>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">

                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h3 class="card-title">
                                <center>Amonia</center>
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <h1 class="card-title bigger">
                                    <center id="amoniaRealtime">Wait..</center>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-chart">

                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h3 class="card-title">
                                <center>Kekeruhan</center>
                                </h2>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <h1 class="card-title bigger">
                                    <center id="keruhRealtime">Wait..</center>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@push('js')
    {{-- <script src="{{ asset('black/src/black-stubs/resources/assets/js/plugins/chartjs.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('black/src/black-stubs/resources/assets/js/black-dashboard.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script>
@endpush
