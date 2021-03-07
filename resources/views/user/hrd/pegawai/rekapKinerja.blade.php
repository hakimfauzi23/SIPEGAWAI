@extends('user.layouts.base')

@section('title', 'Data Pegawai')

@section('content')

    <!-- Start top-section Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center text-center banner-content">
                <div class="col-lg-12">
                    <h1 class="text-white">Data Pegawai</h1>
                    <p>Mengelola Semua Data Pegawai Perusahaan dengan Efisien </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-section Area -->


    <section class="about-area section-gap">
        <div class="container">

            <div class="section-title text-center">
                <h4>Rekap Kehadiran Pegawai</h4>
            </div>


            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-7 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Riwayat Ketidakhadiran</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table style="text-align:center" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>@sortablelink('tanggal','TANGGAL')</th>
                                        <th>@sortablelink('ket','KETERANGAN')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($presensiTdkHadir->count())
                                        @foreach ($presensiTdkHadir as $key => $p)
                                            <tr>
                                                <td>{{ $p->tanggal }}</td>
                                                <td>{{ $p->ket }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <br />
                            <div class="pagenation">

                                Page : {{ $presensiTdkHadir->currentPage() }}
                                || Total Data : {{ $presensiTdkHadir->total() }}

                                {{ $presensiTdkHadir->appends(['cuti' => $cuti->currentPage()])->links() }}


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Persentase Kehadiran Bulan Ini</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Hadir
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Tidak Hadir
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5 col-lg-5">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Jumlah Cuti Digunakan</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Riwayat Cuti</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table style="text-align:center" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>@sortablelink('tgl_mulai','TGL MULAI')</th>
                                        <th>@sortablelink('tgl_selesai','TGL_SELESAI')</th>
                                        <th>@sortablelink('tipe_cuti','TIPE')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cuti->count())
                                        @foreach ($cuti as $key => $p)
                                            <tr>
                                                <td>{{ $p->tgl_mulai }}</td>
                                                <td>{{ $p->tgl_selesai }}</td>
                                                <td>{{ $p->tipe_cuti }}</td>
                                                <td>
                                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                    <a href="{{ route('cuti.details', $encyrpt) }}"
                                                        class="btn btn-success">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <br />
                            <div class="pagenation">

                                Page : {{ $cuti->currentPage() }}
                                || Total Data : {{ $cuti->total() }}
                                {{ $cuti->appends(['presensi' => $presensiTdkHadir->currentPage()])->links() }}

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customScript')
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Hadir", "Tidak Hadir"],
                datasets: [{
                    data: [{{ $persentaseHadir }}, {{ $persentaseTdkHadir }}],
                    backgroundColor: ['#4e73df', '#1cc88a'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 50,
            },
        });

    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Tahunan", "Besar", "Bersama", "Hamil", "Sakit", "Penting"],
                datasets: [{
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [{{ $tahunan }}, {{ $besar }}, {{ $bersama }},
                        {{ $hamil }}, {{ $sakit }}, {{ $penting }}
                    ],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 15,
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value) + ' hari';
                            }
                        },
                        gridLines: {
                            color: "rgb(255, 0, 0)",
                            zeroLineColor: "rgb(255, 0, 0)",
                            drawBorder: true,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return number_format(tooltipItem.yLabel);
                        }
                    }
                },
            }
        });

    </script>
@endsection
