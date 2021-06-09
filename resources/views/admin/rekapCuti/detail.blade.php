@extends('layout.base')

@section('title', 'Rekap Cuti')



@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture position-left"></i> <span class="text-semibold">Data Cuti</span>
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
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Halaman ini berisi mengenai rekap data cuti pegawai yang telah dipilih pada halaman sebelumnya.
                        <br>Di halaman ada beberapa informasi seperti Statistik Cuti Perbulan, Riwayat Cuti Pegawai dan lain-lain.
                    </h6>
                </em>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
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
            @if ($pegawai->jk != 'Wanita')
                <canvas id="canvas1"></canvas>
            @else
                <canvas id="canvas2"></canvas>
            @endif

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
        @php
            
            $tgl_masuk = $pegawai->tgl_masuk;
            $tgl_now = date('Y-m-d');
            
            $ts1 = strtotime($tgl_masuk);
            $ts2 = strtotime($tgl_now);
            
            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
            
            $months = ($year2 - $year1) * 12 + ($month2 - $month1);
            
        @endphp
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
                            @if ($months < $syarat_bulan_cuti_tahunan)
                                <p> 0 Hari</p>
                            @else
                                <p> {{ $sisaTahunan }} Hari</p>
                            @endif
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
                            @if ($months < $syarat_bulan_cuti_besar)
                                <p> 0 Hari</p>
                            @else
                                <p> {{ $sisaBesar }} Hari</p>
                            @endif
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
                            @if ($pegawai->jk != 'Wanita')
                                <p> 0 Hari</p>
                            @else
                                <p> {{ $sisaHamil }} Hari</p>
                            @endif
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

    {{-- <script>
        var barChartData = {
            labels: [
                "Jan", "Feb", "Mar",
                "Apr", "May", "Jun",
                "Jul", "Aug", "Sep",
                "Oct", "Nov", "Dec",
            ],
            datasets: [{
                    label: "Tahunan",
                    backgroundColor: "orangered",
                    borderColor: "maroon",
                    borderWidth: 1,
                    data: [
                        {{ $JanTahunan }}, {{ $FebTahunan }}, {{ $MarTahunan }},
                        {{ $AprTahunan }}, {{ $MayTahunan }}, {{ $JunTahunan }},
                        {{ $JulTahunan }}, {{ $AugTahunan }}, {{ $SepTahunan }},
                        {{ $OctTahunan }}, {{ $NovTahunan }}, {{ $DecTahunan }}
                    ]
                },
                {
                    label: "Bersama",
                    backgroundColor: "red",
                    borderColor: "black",
                    borderWidth: 1,
                    data: [
                        {{ $JanBersama }}, {{ $FebBersama }}, {{ $MarBersama }},
                        {{ $AprBersama }}, {{ $MayBersama }}, {{ $JunBersama }},
                        {{ $JulBersama }}, {{ $AugBersama }}, {{ $SepBersama }},
                        {{ $OctBersama }}, {{ $NovBersama }}, {{ $DecBersama }}
                    ]
                },
                {
                    label: "Penting",
                    backgroundColor: "lightblue",
                    borderColor: "blue",
                    borderWidth: 1,
                    data: [
                        {{ $JanPenting }}, {{ $FebPenting }}, {{ $MarPenting }},
                        {{ $AprPenting }}, {{ $MayPenting }}, {{ $JunPenting }},
                        {{ $JulPenting }}, {{ $AugPenting }}, {{ $SepPenting }},
                        {{ $OctPenting }}, {{ $NovPenting }}, {{ $DecPenting }}
                    ]
                },
                {
                    label: "Sakit",
                    backgroundColor: "gold",
                    borderColor: "orange",
                    borderWidth: 1,
                    data: [
                        {{ $JanSakit }}, {{ $FebSakit }}, {{ $MarSakit }},
                        {{ $AprSakit }}, {{ $MaySakit }}, {{ $JunSakit }},
                        {{ $JulSakit }}, {{ $AugSakit }}, {{ $SepSakit }},
                        {{ $OctSakit }}, {{ $NovSakit }}, {{ $DecSakit }}
                    ]
                },
                {
                    label: "Besar",
                    backgroundColor: "lightgreen",
                    borderColor: "green",
                    borderWidth: 1,
                    data: [
                        {{ $JanBesar }}, {{ $FebBesar }}, {{ $MarBesar }},
                        {{ $AprBesar }}, {{ $MayBesar }}, {{ $JunBesar }},
                        {{ $JulBesar }}, {{ $AugBesar }}, {{ $SepBesar }},
                        {{ $OctBesar }}, {{ $NovBesar }}, {{ $DecBesar }}
                    ]
                },
                {
                    label: "Hamil",
                    backgroundColor: "rebeccapurple",
                    borderColor: "indigo",
                    borderWidth: 1,
                    data: [
                        {{ $JanHamil }}, {{ $FebHamil }}, {{ $MarHamil }},
                        {{ $AprHamil }}, {{ $MayHamil }}, {{ $JunHamil }},
                        {{ $JulHamil }}, {{ $AugHamil }}, {{ $SepHamil }},
                        {{ $OctHamil }}, {{ $NovHamil }}, {{ $DecHamil }}
                    ]
                }

            ]
        };

        var chartOptions = {
            responsive: true,
            legend: {
                position: "top"
            },
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

                }, ],
            }

        }

        window.onload = function() {
            var ctx = document.getElementById("chartHamil").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: "bar",
                data: barChartData,
                options: chartOptions
            });
        };

    </script> --}}

    <script>
        var canvas1 = document.getElementById("canvas1");

        var barChartData = {
            labels: [
                "Jan", "Feb", "Mar",
                "Apr", "May", "Jun",
                "Jul", "Aug", "Sep",
                "Oct", "Nov", "Dec",
            ],
            datasets: [{
                    label: "Tahunan",
                    backgroundColor: "orangered",
                    borderColor: "maroon",
                    borderWidth: 1,
                    data: [
                        {{ $JanTahunan }}, {{ $FebTahunan }}, {{ $MarTahunan }},
                        {{ $AprTahunan }}, {{ $MayTahunan }}, {{ $JunTahunan }},
                        {{ $JulTahunan }}, {{ $AugTahunan }}, {{ $SepTahunan }},
                        {{ $OctTahunan }}, {{ $NovTahunan }}, {{ $DecTahunan }}
                    ]
                },
                {
                    label: "Bersama",
                    backgroundColor: "red",
                    borderColor: "black",
                    borderWidth: 1,
                    data: [
                        {{ $JanBersama }}, {{ $FebBersama }}, {{ $MarBersama }},
                        {{ $AprBersama }}, {{ $MayBersama }}, {{ $JunBersama }},
                        {{ $JulBersama }}, {{ $AugBersama }}, {{ $SepBersama }},
                        {{ $OctBersama }}, {{ $NovBersama }}, {{ $DecBersama }}
                    ]
                },
                {
                    label: "Penting",
                    backgroundColor: "lightblue",
                    borderColor: "blue",
                    borderWidth: 1,
                    data: [
                        {{ $JanPenting }}, {{ $FebPenting }}, {{ $MarPenting }},
                        {{ $AprPenting }}, {{ $MayPenting }}, {{ $JunPenting }},
                        {{ $JulPenting }}, {{ $AugPenting }}, {{ $SepPenting }},
                        {{ $OctPenting }}, {{ $NovPenting }}, {{ $DecPenting }}
                    ]
                },
                {
                    label: "Sakit",
                    backgroundColor: "gold",
                    borderColor: "orange",
                    borderWidth: 1,
                    data: [
                        {{ $JanSakit }}, {{ $FebSakit }}, {{ $MarSakit }},
                        {{ $AprSakit }}, {{ $MaySakit }}, {{ $JunSakit }},
                        {{ $JulSakit }}, {{ $AugSakit }}, {{ $SepSakit }},
                        {{ $OctSakit }}, {{ $NovSakit }}, {{ $DecSakit }}
                    ]
                },
                {
                    label: "Besar",
                    backgroundColor: "lightgreen",
                    borderColor: "green",
                    borderWidth: 1,
                    data: [
                        {{ $JanBesar }}, {{ $FebBesar }}, {{ $MarBesar }},
                        {{ $AprBesar }}, {{ $MayBesar }}, {{ $JunBesar }},
                        {{ $JulBesar }}, {{ $AugBesar }}, {{ $SepBesar }},
                        {{ $OctBesar }}, {{ $NovBesar }}, {{ $DecBesar }}
                    ]
                },
            ]
        };

        var chartOptions = {
            responsive: true,
            legend: {
                position: "top"
            },
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

                }, ],
            }

        }

        var barChart = new Chart(canvas1, {
            type: "bar",
            data: barChartData,
            options: chartOptions
        });

    </script>


    <script>
        var canvas2 = document.getElementById("canvas2");

        var barChartData = {
            labels: [
                "Jan", "Feb", "Mar",
                "Apr", "May", "Jun",
                "Jul", "Aug", "Sep",
                "Oct", "Nov", "Dec",
            ],
            datasets: [{
                    label: "Tahunan",
                    backgroundColor: "orangered",
                    borderColor: "maroon",
                    borderWidth: 1,
                    data: [
                        {{ $JanTahunan }}, {{ $FebTahunan }}, {{ $MarTahunan }},
                        {{ $AprTahunan }}, {{ $MayTahunan }}, {{ $JunTahunan }},
                        {{ $JulTahunan }}, {{ $AugTahunan }}, {{ $SepTahunan }},
                        {{ $OctTahunan }}, {{ $NovTahunan }}, {{ $DecTahunan }}
                    ]
                },
                {
                    label: "Bersama",
                    backgroundColor: "red",
                    borderColor: "black",
                    borderWidth: 1,
                    data: [
                        {{ $JanBersama }}, {{ $FebBersama }}, {{ $MarBersama }},
                        {{ $AprBersama }}, {{ $MayBersama }}, {{ $JunBersama }},
                        {{ $JulBersama }}, {{ $AugBersama }}, {{ $SepBersama }},
                        {{ $OctBersama }}, {{ $NovBersama }}, {{ $DecBersama }}
                    ]
                },
                {
                    label: "Penting",
                    backgroundColor: "lightblue",
                    borderColor: "blue",
                    borderWidth: 1,
                    data: [
                        {{ $JanPenting }}, {{ $FebPenting }}, {{ $MarPenting }},
                        {{ $AprPenting }}, {{ $MayPenting }}, {{ $JunPenting }},
                        {{ $JulPenting }}, {{ $AugPenting }}, {{ $SepPenting }},
                        {{ $OctPenting }}, {{ $NovPenting }}, {{ $DecPenting }}
                    ]
                },
                {
                    label: "Sakit",
                    backgroundColor: "gold",
                    borderColor: "orange",
                    borderWidth: 1,
                    data: [
                        {{ $JanSakit }}, {{ $FebSakit }}, {{ $MarSakit }},
                        {{ $AprSakit }}, {{ $MaySakit }}, {{ $JunSakit }},
                        {{ $JulSakit }}, {{ $AugSakit }}, {{ $SepSakit }},
                        {{ $OctSakit }}, {{ $NovSakit }}, {{ $DecSakit }}
                    ]
                },
                {
                    label: "Besar",
                    backgroundColor: "lightgreen",
                    borderColor: "green",
                    borderWidth: 1,
                    data: [
                        {{ $JanBesar }}, {{ $FebBesar }}, {{ $MarBesar }},
                        {{ $AprBesar }}, {{ $MayBesar }}, {{ $JunBesar }},
                        {{ $JulBesar }}, {{ $AugBesar }}, {{ $SepBesar }},
                        {{ $OctBesar }}, {{ $NovBesar }}, {{ $DecBesar }}
                    ]
                },
                {
                    label: "Hamil",
                    backgroundColor: "rebeccapurple",
                    borderColor: "indigo",
                    borderWidth: 1,
                    data: [
                        {{ $JanHamil }}, {{ $FebHamil }}, {{ $MarHamil }},
                        {{ $AprHamil }}, {{ $MayHamil }}, {{ $JunHamil }},
                        {{ $JulHamil }}, {{ $AugHamil }}, {{ $SepHamil }},
                        {{ $OctHamil }}, {{ $NovHamil }}, {{ $DecHamil }}
                    ]
                }

            ]
        };

        var chartOptions = {
            responsive: true,
            legend: {
                position: "top"
            },
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

                }, ],
            }

        }

        var barChart = new Chart(canvas2, {
            type: "bar",
            data: barChartData,
            options: chartOptions
        });

    </script>


@endsection
