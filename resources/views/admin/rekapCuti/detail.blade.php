@extends('layout.base')

@section('title', 'Rekap Cuti')



@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture position-left"></i> <span class="text-semibold">Rekap Data Cuti</span>
                    - Rekap Data Cuti </h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ route('rekapCuti.index') }}"><i class="active icon-home2 position-left"></i> List
                        Data
                        Pegawai</a></li>
                <li class="active">Details Rekapan Cuti ID Pegawai : {{ $pegawai->id }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="panel">
            <div class="panel-heading bg-info text-center">
                <h5 class="panel-title"> Statistik Cuti Per Bulan</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class=" icon-more2"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="" data-toggle="modal" data-target="#modal_form_tahun"> <i
                                            class=" icon-pencil7"></i> Ganti Tahun </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>

            </div>
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading bg-info text-center">
                    <h5 class="panel-title">Riwayat Cuti</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive pre-scrollable">
                    <table class="table datatable-basic table-xs">
                        <thead>
                            <tr>
                                <th>Tgl Pengajuan</th>
                                <th>Tipe Cuti</th>
                                <th> Keterangan</th>
                                <th> Tgl Mulai</th>
                                <th> Tgl Selesai</th>
                                <th hidden></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($riwayatCuti->count())
                                @foreach ($riwayatCuti as $key => $p)
                                    <tr>
                                        <td>{{ $p->tgl_pengajuan }}</td>
                                        <td> {{ $p->tipe_cuti }}</td>
                                        <td> {{ $p->ket }}</td>
                                        <td> {{ $p->tgl_mulai }}</td>
                                        <td> {{ $p->tgl_selesai }}</td>
                                        <td hidden></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel bg-warning">
                        <div class="panel-heading">
                            <p class="panel-title">Sisa Cuti Tahunan</p>
                            <div class="heading-elements">
                            </div>

                        </div>
                        <div class="panel-body text-center">
                            <p> {{ $sisaTahunan }} Hari</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel bg-danger">
                        <div class="panel-heading">
                            <p class="panel-title">Sisa Cuti Bersama</p>
                            <div class="heading-elements">
                            </div>

                        </div>
                        <div class="panel-body text-center">
                            <p> {{ $sisaBersama }} Hari</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel bg-info">
                        <div class="panel-heading">
                            <p class="panel-title">Sisa Cuti Penting</p>
                            <div class="heading-elements">
                            </div>

                        </div>
                        <div class="panel-body text-center">
                            <p> {{ $sisaPenting }} Hari</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel bg-orange-400">
                        <div class="panel-heading">
                            <p class="panel-title">Sisa Cuti Sakit</p>
                            <div class="heading-elements">
                            </div>

                        </div>
                        <div class="panel-body text-center">
                            <p> {{ $sisaSakit }} Hari</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel bg-success">
                        <div class="panel-heading">
                            <p class="panel-title">Sisa Cuti Besar</p>
                            <div class="heading-elements">
                            </div>

                        </div>
                        <div class="panel-body text-center">
                            <p> {{ $sisaBesar }} Hari</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel bg-indigo">
                        <div class="panel-heading">
                            <p class="panel-title">Sisa Cuti Hamil</p>
                            <div class="heading-elements">
                            </div>

                        </div>
                        <div class="panel-body text-center">
                            <p> {{ $sisaHamil }} Hari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jamMasuk form modal -->
    <div id="modal_form_tahun" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Tahun</h5>
                </div>
                <form action="{{ route('rekapCuti.showYear', $id_pegawai) }}" method="get">

                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahun </label>
                            <input name="year" type="text" class="form-control" value="{{ $thisYear }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Go!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->

@endsection


@section('custom_script')

    <script>
        var canvas = document.getElementById("barChart");
        var ctx = canvas.getContext('2d');

        // Global Options:
        Chart.defaults.global.defaultFontColor = 'black';
        Chart.defaults.global.defaultFontSize = 13;

        var data = {
            labels: [
                "Januari", "Febuari", "Maret",
                "April", "Mei", "Juni",
                "Juli", "Agustus", "September",
                "October", "November", "December"
            ],
            datasets: [{
                label: "Tahunan",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(225,0,0,0.4)",
                borderColor: "darkorange", // The main line color
                borderCapStyle: 'square',
                borderDash: [], // try [5, 15] for instance
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "black",
                pointBackgroundColor: "white",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "yellow",
                pointHoverBorderColor: "brown",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: true
                data: [
                    {{ $JanTahunan }}, {{ $FebTahunan }}, {{ $MarTahunan }},
                    {{ $AprTahunan }}, {{ $MayTahunan }}, {{ $JunTahunan }},
                    {{ $JulTahunan }}, {{ $AugTahunan }}, {{ $SepTahunan }},
                    {{ $OctTahunan }}, {{ $NovTahunan }}, {{ $DecTahunan }}
                ],
                spanGaps: true,
            }, {
                label: "Bersama",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(225,0,0,0.4)",
                borderColor: "red", // The main line color
                borderCapStyle: 'square',
                borderDash: [], // try [5, 15] for instance
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "black",
                pointBackgroundColor: "white",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "yellow",
                pointHoverBorderColor: "brown",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: true
                data: [
                    {{ $JanBersama }}, {{ $FebBersama }}, {{ $MarBersama }},
                    {{ $AprBersama }}, {{ $MayBersama }}, {{ $JunBersama }},
                    {{ $JulBersama }}, {{ $AugBersama }}, {{ $SepBersama }},
                    {{ $OctBersama }}, {{ $NovBersama }}, {{ $DecBersama }}
                ],
                spanGaps: true,
            }, {
                label: "Penting",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(225,0,0,0.4)",
                borderColor: "aqua", // The main line color
                borderCapStyle: 'square',
                borderDash: [], // try [5, 15] for instance
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "black",
                pointBackgroundColor: "white",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "yellow",
                pointHoverBorderColor: "brown",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: true
                data: [
                    {{ $JanPenting }}, {{ $FebPenting }}, {{ $MarPenting }},
                    {{ $AprPenting }}, {{ $MayPenting }}, {{ $JunPenting }},
                    {{ $JulPenting }}, {{ $AugPenting }}, {{ $SepPenting }},
                    {{ $OctPenting }}, {{ $NovPenting }}, {{ $DecPenting }}
                ],
                spanGaps: true,
            }, {
                label: "Besar",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(225,0,0,0.4)",
                borderColor: "limegreen", // The main line color
                borderCapStyle: 'square',
                borderDash: [], // try [5, 15] for instance
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "black",
                pointBackgroundColor: "white",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "yellow",
                pointHoverBorderColor: "brown",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: true
                data: [
                    {{ $JanBesar }}, {{ $FebBesar }}, {{ $MarBesar }},
                    {{ $AprBesar }}, {{ $MayBesar }}, {{ $JunBesar }},
                    {{ $JulBesar }}, {{ $AugBesar }}, {{ $SepBesar }},
                    {{ $OctBesar }}, {{ $NovBesar }}, {{ $DecBesar }}
                ],
                spanGaps: true,
            }, {
                label: "Sakit",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(225,0,0,0.4)",
                borderColor: "yellow", // The main line color
                borderCapStyle: 'square',
                borderDash: [], // try [5, 15] for instance
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "black",
                pointBackgroundColor: "white",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "yellow",
                pointHoverBorderColor: "brown",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: true
                data: [
                    {{ $JanSakit }}, {{ $FebSakit }}, {{ $MarSakit }},
                    {{ $AprSakit }}, {{ $MaySakit }}, {{ $JunSakit }},
                    {{ $JulSakit }}, {{ $AugSakit }}, {{ $SepSakit }},
                    {{ $OctSakit }}, {{ $NovSakit }}, {{ $DecSakit }}
                ],
                spanGaps: true,
            }, {
                label: "Hamil",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(225,0,0,0.4)",
                borderColor: "indigo", // The main line color
                borderCapStyle: 'square',
                borderDash: [], // try [5, 15] for instance
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "black",
                pointBackgroundColor: "white",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "yellow",
                pointHoverBorderColor: "brown",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: true
                data: [
                    {{ $JanHamil }}, {{ $FebHamil }}, {{ $MarHamil }},
                    {{ $AprHamil }}, {{ $MayHamil }}, {{ $JunHamil }},
                    {{ $JulHamil }}, {{ $AugHamil }}, {{ $SepHamil }},
                    {{ $OctHamil }}, {{ $NovHamil }}, {{ $DecHamil }}
                ],
                spanGaps: true,
            }]
        };

        // Notice the scaleLabel at the same level as Ticks
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: {{ $thisYear }},
                        fontSize: 20
                    }
                }]
            }
        };

        // Chart declaration:
        var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });

    </script>
@endsection
