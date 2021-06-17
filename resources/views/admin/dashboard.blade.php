@extends('layout.base')

@section('title', 'Dashboard')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-rocket position-left"></i> <span class="text-semibold">Dashboard</span>
                    - Admin</h4>
            </div>

        </div>

    </div>
@endsection

@section('content')

    <div class="col-md-12">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Berikut adalah dashboard untuk <b>Super-Admin</b> yang berisi informasi mengenai jumlah semua data
                        yang berada di dalam aplikasi ini.</h6>
                </em>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Data Sistem Informasi</h6>
            </div>

            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-users2 position-left text-slate"></i>
                                {{ $jml_pegawai }}
                            </h5>
                            <span class="text-muted text-size-small">Data Pegawai</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-hat position-left text-slate"></i>
                                {{ $jml_divisi }}
                            </h5>
                            <span class="text-muted text-size-small">Data Divisi</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-user-tie position-left text-slate"></i>
                                {{ $jml_jabatan }}
                            </h5>
                            <span class="text-muted text-size-small">Data Jabatan</span>
                        </div>
                    </div>
                </div>
                <div class="mt-3"></div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-notebook position-left text-slate"></i>
                                {{ $jml_presensi }}
                            </h5>
                            <span class="text-muted text-size-small">Data Presensi</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-furniture position-left text-slate"></i>
                                {{ $jml_cuti }}
                            </h5>
                            <span class="text-muted text-size-small">Data Cuti</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <h5 class="panel-title">Kebijakan & Peraturan Kantor </h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class=" icon-more2"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{{ route('peraturan.index') }}"> <i class=" fa fa-eye"></i> Lihat
                                        Selengkapnya </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="fa fa-clock-o position-left text-slate"></i>
                                {{ date('H:i', strtotime($peraturan->jam_masuk)) }}
                            </h5>
                            <span class="text-muted text-size-small">Jam Masuk</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i
                                    class="fa fa-clock-o position position-left text-slate"></i>
                                {{ date('H:i', strtotime($peraturan->jam_plg)) }}
                            </h5>
                            <span class="text-muted text-size-small">Jam Pulang</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="fa fa-hourglass-1 position-left text-slate"></i>
                                {{ $peraturan->syarat_bulan_cuti_tahunan }} Bln
                            </h5>
                            <span class="text-muted text-size-small">Durasi Kerja untuk Cuti Tahunan</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="fa fa-hourglass position-left text-slate"></i>
                                {{ $peraturan->syarat_bulan_cuti_besar }} Bln
                            </h5>
                            <span class="text-muted text-size-small">Durasi Kerja untuk Cuti Besar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h5 class="panel-title">Statistik Inputan Data </h5>
                <div class="heading-elements">
                    <form class="heading-form" method="post" action="{{ route('superAdmin.store') }}">
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
                    <canvas id="chartData"></canvas>
                </div>
            </div>
        </div>
        <!-- /bacis pie chart -->
    </div>

    <!-- Vertical form modal -->
    <div id="modal" class="modal fade" data-toggle="modal" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Masukan Informasi Perusahaan</h5>
                </div>

                <form method="post" enctype="multipart/form-data" action="{{ route('perusahaan.store') }}">

                    {{ csrf_field() }}

                    <div class="modal-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col">
                            <legend class="text-semibold"><i class="icon-office position-left"></i> Informasi
                                Perusahaan
                            </legend>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" name="nama" placeholder="Contoh : PT Sejahtera . . ."
                                        class="form-control" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Alamat Perusahaan</label>
                                    <textarea name="alamat" id="" cols="30" rows="3" class="form-control"
                                        placeholder="Masukan alamat perusahaan" required="required"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for=""> Kota Perusahaan</label>
                                    <textarea name="kota" id="" cols="30" rows="3" class="form-control"
                                        placeholder="Masukan khusus kota/kabupaten perusahaan "
                                        required="required"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for=""> No Telp Perusahaan</label>
                                        <input type="text" name="no_telp" placeholder="(028x) 54xxxx" class="form-control"
                                            required="required">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for=""> Email Perusahaan</label>
                                        <input type="text" name="email_public" placeholder="email untuk info perusahaan"
                                            class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for=""> Upload Logo Perusahaan (Background Transparan) </label>
                                    <input type="file" name="path_logo" class="file-styled" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <legend class="text-semibold"><i class="icon-mail5 position-left"></i> Email Untuk
                                Aplikasi
                            </legend>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for=""> Email Perusahaan </label>
                                    <input type="text" name="email_private" placeholder="Contoh : sipegawai@gmail.com"
                                        class="form-control" required="required">
                                </div>
                                <div class="col-sm-6">
                                    <label for=""> Pass Email Perusahaan</label>
                                    <input type="password" name="password" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12 text-bold text-center">
                                Email untuk aplikasi sistem ini wajib diatur seperti pada gambar berikut! <a
                                    href="https://i.postimg.cc/YSnTPQSd/Screenshot-from-2021-06-17-14-41-01.png"
                                    target="_blank"> Link</a>
                            </div>

                        </div>

                        <div class="row">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->
@endsection


@section('custom_script')

    <script>
        if ({{ $perusahaan }} == 0) {

            setTimeout(function() {
                $("#modal").modal('show');
            }, 100);

        }

        var oilCanvas = document.getElementById("chartData");

        Chart.defaults.global.defaultFontColor = 'black';
        Chart.defaults.global.defaultFontSize = 13;

        var inputData = {
            labels: [
                "Data Pegawai",
                "Data Presensi",
                "Data Cuti",
            ],
            datasets: [{
                data: [{{ $pegawai_bulan }}, {{ $presensi_bulan }}, {{ $cuti_bulan }}],
                backgroundColor: [
                    "teal",
                    "indigo",
                    "navy",
                ]
            }]
        };

        var pieChart = new Chart(oilCanvas, {
            type: 'pie',
            data: inputData
        });

    </script>

@endsection
