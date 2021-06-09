@extends('layout.base')

@section('title', 'Rekap Presensi')



@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook position-left"></i> <span class="text-semibold">Data Presensi</span>
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
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Halaman ini berisi mengenai rekap data presensi pegawai yang telah dipilih pada halaman sebelumnya.
                    <br>Di halaman ada beberapa informasi seperti Riwayat tidak hadir pegawai, Grafik yang menunjukan
                    Persentase Kehadiran, dan lain-lain.
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="row mb-4 text-center">
        <?php
        $encyrpt = Crypt::encryptString($pegawai->id);
        $i = 1;
        ?>
    </div>
    <div class="panel">
        <div class="panel-body">
            <div class="col-mt-3"></div>
            <form method="get" action="{{ route('rekapPresensi.search', $encyrpt) }}">

                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input class="form-control" type="text" id="datepicker" name="year" value="{{ $tahunIni }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <select class="select" data-live-search="true" searchable="Search here.." name="month">
                                <option>Pilih Bulan</option>
                                @foreach ($months as $value => $key)
                                    <option value="{{ $key }}" {{ $bulanIni == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3"></div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Browse <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>

        </div>
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

                <div class="table-responsive pre-scrollable">
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
                    <div class="text-center">
                        @if ($checkData != 0)
                            <canvas id="chartPersentase"></canvas>
                        @else
                            Belum Ada Data!!
                        @endif
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
                    <div class="text-right">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <script>
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });

        </script>
        <script>
            var oilCanvas = document.getElementById("chartPersentase");

            Chart.defaults.global.defaultFontColor = 'black';
            Chart.defaults.global.defaultFontSize = 13;

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
