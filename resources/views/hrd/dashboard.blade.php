@extends('layout.base')

@section('title', 'Dashboard')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-rocket position-left"></i> <span class="text-semibold">Dashboard</span>
                    - HRD</h4>
            </div>

        </div>

    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Berikut adalah dashboard untuk <b>HRD</b> yang berisi informasi aktivitas pegawai seperti yang Pegawai
                    yang Cuti Minggu Ini, Grafik kehadiran
                    <br>pegawai perbulan, Pegawai yang Sering terlambat, dan lain-lain.
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title">Pegawai Yang Cuti Minggu Ini</h6>
                </div>

                <div class="panel-body">
                    <div class="table-responsive pre-scrollable">
                        <table class="table datatable-basic table-xs">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th> Nama </th>
                                    <th>Divisi</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal</th>
                                    <th hidden></th>
                                    <th hidden></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cuti->count())
                                    @foreach ($cuti as $key => $p)
                                        <tr>
                                            <td>{{ $p->pegawai->id }}</td>
                                            <td> {{ $p->pegawai->nama }}</td>
                                            <td> {{ $p->pegawai->divisi->nm_divisi }}</td>
                                            <td> {{ $p->pegawai->jabatan->nm_jabatan }}</td>
                                            <td> {{ date('d M Y', strtotime($p->tanggal)) }}</td>
                                            <td hidden></td>
                                            <td hidden></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title">Grafik Kedisiplinan Pegawai</h6>
                </div>

                <div class="panel-body">
                    <canvas id="speedChart"></canvas>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title">Pegawai yang WFH hari Ini</h6>
                </div>
                <div class="panel-body">
                    <div class="table-responsive pre-scrollable">
                        <table class="table datatable-basic table-xs">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th> Nama </th>
                                    <th>Divisi</th>
                                    <th>Jabatan</th>
                                    <th hidden></th>
                                    <th hidden></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pegWfh->count())
                                    @foreach ($pegWfh as $key => $p)
                                        <tr>
                                            <td>{{ $p->pegawai->id }}</td>
                                            <td> {{ $p->pegawai->nama }}</td>
                                            <td> {{ $p->pegawai->divisi->nm_divisi }}</td>
                                            <td> {{ $p->pegawai->jabatan->nm_jabatan }}</td>
                                            <td hidden></td>
                                            <td hidden></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-5">
            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title">Grafik Kehadiran Pegawai Per Bulan</h6>
                    <div class="heading-elements">
                        <form class="heading-form" method="post" action="{{ route('hrd.grafKehadiran') }}">
                            @csrf
                            <div class="form-group">
                                <select class="select" name="month" onchange="this.form.submit();">
                                    @foreach ($months as $value => $key)
                                        <option value="{{ $key }}" {{ $bulanIni == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="text-right">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title">Pegawai Dalam Pengawasan</h6>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table  table-xs">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            @if ($pegawaiDlmPengawasan->count())
                                <tbody>
                                    @foreach ($pegawaiDlmPengawasan as $key => $p)
                                        <tr>
                                            <td>{{ $p->id_pegawai }}</td>
                                            <td> {{ $p->pegawai->nama }}</td>
                                            <td> SP-{{ $p->tingkat }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Belum Ada Data!!</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>

                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title">10 Pegawai Terbaik Bulan ini</h6>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table  table-xs">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>Divisi </th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @if ($top10->count())
                                <tbody>
                                    @foreach ($top10 as $key => $p)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td> {{ $p->pegawai->nama }}</td>
                                            <td> {{ $p->pegawai->divisi->nm_divisi }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td><a href="{{ route('penilaian.showAll') }}">Lihat selengkapnya</a></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Belum Ada Data!!</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('custom_script')
    <script>
        var ctx = document.getElementById("myChart").getContext("2d");

        var data = {
            labels: ["Kehadiran"],
            datasets: [{
                label: "Cuti",
                backgroundColor: "red",
                data: [{{ $JmlCuti }}]
            }, {
                label: "Alpha",
                backgroundColor: "teal",
                data: [{{ $JmlAlpha }}]
            }, {
                label: "Hadir",
                backgroundColor: "indigo",
                data: [{{ $JmlHadir }}]
            }, ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barValueSpacing: 30,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        var speedCanvas = document.getElementById("speedChart");

        Chart.defaults.global.defaultFontSize = 13;

        var speedData = {
            labels: [
                "Jan", "Feb", "Mar", "Apr",
                "May", "Jun", "Jul", "Aug",
                "Sep", "Oct", "Nov", "Dec"
            ],
            datasets: [{
                label: "Terlambat",
                borderColor: 'rgb(255, 5, 5)', // The main line color
                backgroundColor: 'rgba(255, 5, 5, 0.639)',
                data: [
                    {{ $JanTelat }}, {{ $FebTelat }}, {{ $MarTelat }},
                    {{ $AprTelat }}, {{ $MayTelat }}, {{ $JunTelat }},
                    {{ $JulTelat }}, {{ $AugTelat }}, {{ $SepTelat }},
                    {{ $OctTelat }}, {{ $NovTelat }}, {{ $DecTelat }},
                ],
            }, {
                label: "Tepat Waktu",
                borderColor: 'rgb(5, 255, 55)', // The main line color
                backgroundColor: 'rgba(5, 255, 55, 0.537)',
                data: [
                    {{ $JanTepat }}, {{ $FebTepat }}, {{ $MarTepat }},
                    {{ $AprTepat }}, {{ $MayTepat }}, {{ $JunTepat }},
                    {{ $JulTepat }}, {{ $AugTepat }}, {{ $SepTepat }},
                    {{ $OctTepat }}, {{ $NovTepat }}, {{ $DecTepat }},
                ],
            }, {
                label: "Pulang Awal",
                borderColor: 'rgb(255, 255, 5)', // The main line color
                backgroundColor: 'rgba(255, 255, 5, 0.496)',
                data: [
                    {{ $JanAwal }}, {{ $FebAwal }}, {{ $MarAwal }},
                    {{ $AprAwal }}, {{ $MayAwal }}, {{ $JunAwal }},
                    {{ $JulAwal }}, {{ $AugAwal }}, {{ $SepAwal }},
                    {{ $OctAwal }}, {{ $NovAwal }}, {{ $DecAwal }},
                ],
            }]
        };

        var chartOptions = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 80,
                    fontColor: 'black'
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                }]
            }
        };

        var lineChart = new Chart(speedCanvas, {
            type: 'line',
            data: speedData,
            options: chartOptions
        });
    </script>
@endsection
