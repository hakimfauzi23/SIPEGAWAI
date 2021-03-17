@extends('admin.layout.base')

@section('title', 'Rekap Presensi')



@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook position-left"></i> <span class="text-semibold">Rekap Data Presensi</span>
                    - Rekap Data Presensi </h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ route('rekapPresensi.index') }}"><i class="active icon-home2 position-left"></i> List
                        Data
                        Pegawai</a></li>
                <li class="active">Details Rekapan Presensi ID Pegawai : {{ $pegawai->id }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="row mb-4 text-center">
        <?php
        $encyrpt = Crypt::encryptString($pegawai->id);
        $i = 1;
        ?>
        @foreach ($months as $item)
            <a href="{{ route('rekapPresensi.showMonth', ['data' => $encyrpt, 'thisMonth' => $item, 'intMonth' => $i++]) }}"
                @if ($bulanIni == $item) class="btn btn-success mr-3"
            @else class="btn btn-info mr-3" @endif>{{ $item }}</a>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading bg-info">
                    <h5 class="panel-title">Riwayat Tidak Hadir (Termasuk Cuti)</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive pre-scrollable" style="height:290px">
                    <table class="table datatable-basic">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($riwayatTdkHadir->count())
                                @foreach ($riwayatTdkHadir as $key => $p)
                                    <tr>
                                        <td>{{ $p->tanggal }}</td>
                                        <td>
                                            @if ($p->ket == 'Alpha')
                                                <span class="label label-danger">Alpha</span>
                                            @elseif ($p->ket == "Cuti") <span class="label bg-primary">
                                                    Cuti</span>
                                            @endif
                                        </td>
                                        <td hidden></td>
                                        <td hidden></td>
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

        <div class="col-md-6">
            <!-- Basic pie chart -->
            <div class="panel">
                <div class="panel-heading bg-info">
                    <h5 class="panel-title">Persentase Kehadiran Bulan Ini</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="text-right" style="height:250px">
                        <canvas id="chartPersentase"></canvas>
                    </div>
                </div>
            </div>
            <!-- /bacis pie chart -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Basic pie chart -->
            <div class="panel">
                <div class="panel-heading bg-info">
                    <h5 class="panel-title">Grafik Kedisiplinan Waktu Pegawai</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="text-right" style="height:250px">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- /bacis pie chart -->
        </div>

        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading bg-info">
                    <h5 class="panel-title">Riwayat Kehadiran</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive pre-scrollable" style="height:290px">
                    <table class="table datatable-header-basic">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam Datang</th>
                                <th>Jam Pulang</th>
                                <th> Keterangan</th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($riwayatTdkDisiplin->count())
                                @foreach ($riwayatTdkDisiplin as $key => $p)
                                    <tr>
                                        <td>{{ $p->tanggal }}</td>
                                        <td>{{ $p->jam_dtg }}</td>
                                        <td>{{ $p->jam_plg }}</td>
                                        <td>
                                            @if ($p->jam_dtg > $jam_masuk)
                                                <span class="label label-danger">Terlambat</span>
                                            @elseif ($p->jam_plg < $jam_plg) <span class="label bg-indigo">
                                                    Pulang Awal</span>
                                            @endif
                                        </td>
                                        <td hidden></td>
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
    @endsection


    @section('custom_script')

        <script>
            var oilCanvas = document.getElementById("chartPersentase");

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            var oilData = {
                labels: [
                    "Hadir",
                    "Tidak Hadir",
                ],
                datasets: [{
                    data: [{{ $persentaseHadir }}, {{ $persentaseTdkHadir }}],
                    backgroundColor: [
                        "teal",
                        "red",
                    ]
                }]
            };

            var pieChart = new Chart(oilCanvas, {
                type: 'pie',
                data: oilData
            });

        </script>
        <script>
            var ctx = document.getElementById("myChart").getContext("2d");

            var data = {
                labels: ["Presensi"],
                datasets: [{
                    label: "Terlambat",
                    backgroundColor: "red",
                    data: [{{ $telat }}]
                }, {
                    label: "Tepat Waktu",
                    backgroundColor: "teal",
                    data: [{{ $tepatWaktu }}]
                }, {
                    label: "PulangAwal",
                    backgroundColor: "indigo",
                    data: [{{ $pulangAwal }}]
                }, ]
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 20,
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
    @endsection
