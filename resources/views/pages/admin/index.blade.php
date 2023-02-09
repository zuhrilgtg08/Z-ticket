@extends('layouts.dashboard.mainDashboard', ['isActive' => 'dashboard'])

@section('breadcumb')
    <div class="pagetitle">
        <h1>Dahsboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content-dashboard')
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Data Tiket</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-ticket"></i>
                    </div>
                    <div class="ps-3">
                        <h3>{{ $tikets->count() }} Data</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Data Hotel</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                        <h3>0 Data</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-md-4">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title">Akun User</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h3>{{ $users->count() }} Account</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Data 1</h5>
                <!-- Bar Chart -->
                <div id="barChart" style="min-height: 400px;" class="echart"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Data 2</h5>
                <!-- Line Chart -->
                <div id="lineChart" style="min-height: 400px;" class="echart"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var result1 = {{ Js::from($data1) }};
        var result2 = {{ Js::from($data2) }};

        document.addEventListener("DOMContentLoaded", () => {
            echarts.init(document.querySelector("#lineChart")).setOption({
                xAxis: {
                    type: 'category',
                    data: ['user', 'review', 'pesanan']
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                    data: result1,
                    type: 'line',
                    smooth: true
                }]
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            echarts.init(document.querySelector("#barChart")).setOption({
                    xAxis: {
                        type: 'category',
                        data: ['provinsi', 'kota', 'kategori', 'tiket']
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [{
                        data: result2,
                        type: 'bar'
                    }]
                });
            });
    </script>
@endsection