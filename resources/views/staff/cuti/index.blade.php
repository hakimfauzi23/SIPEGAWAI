@extends('layout.base')


@section('title', 'Riwayat Cuti')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Cuti</span>
                    - List Riwayat Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Riwayat Cuti</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- Basic datatable -->
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">List Data Riwayat Cuti Tahun {{ $thisYear }}</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="" data-toggle="modal" data-target="#modal_form_tahun"> <i
                                                class=" icon-calendar"></i>
                                            Pilih Tahun </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body table-responsive">
                    <table class="table datatable-basic table-bordered table-striped table-hover ">
                        <thead class="bg-primary-300">
                            <tr>
                                <th>Tipe Cuti</th>
                                <th>Tgl Pengajuan</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cuti->count())
                                @foreach ($cuti as $key => $p)
                                    <tr>
                                        <td>{{ $p->tipe_cuti }}</td>
                                        <td>{{ date('d-M-Y', strtotime($p->tgl_pengajuan)) }}</td>
                                        <td>{{ date('d-M-Y', strtotime($p->tgl_mulai)) }}</td>
                                        <td>{{ date('d-M-Y', strtotime($p->tgl_selesai)) }}</td>
                                        <td class="text-center"><span <?php if ($p->status == 'Disetujui HRD'
                                                || $p->status == 'Disetujui Atasan') {
                                                echo 'class="label bg-success"';
                                                }
                                                if ($p->status == 'Ditolak HRD' || $p->status == 'Ditolak Atasan') {
                                                echo 'class="label bg-danger"';
                                                }
                                                if ($p->status == 'Diproses') {
                                                echo 'class="label bg-info"';
                                                }
                                                ?>>{{ $p->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                        <li><a href="{{ route('staffCuti.show', $encyrpt) }}"><i
                                                                    class="icon-file-eye"></i> Detail </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">Sisa Cuti Tahun {{ $thisYear }}</h5>
                    <div class="heading-elements">
                    </div>
                </div>

                <div class="panel-body">



                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel bg-warning">
                                <div class="panel-heading">
                                    <p class="panel-title text-center">Sisa Cuti Tahunan</p>
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
                                    <p class="panel-title text-center">Sisa Cuti Bersama</p>
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
                                    <p class="panel-title text-center">Sisa Cuti Penting</p>
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
                                    <p class="panel-title text-center">Sisa Cuti <br> Sakit</p>
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
                                    <p class="panel-title text-center">Sisa Cuti <br> Besar</p>
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
                                    <p class="panel-title  text-center">Sisa Cuti <br> Hamil</p>
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
        </div>

    </div>
    <!-- /basic datatable -->


    <!-- cutiSakit form modal -->
    <div id="modal_form_tahun" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Batas Cuti Sakit</h5>
                </div>
                <form action="{{ route('staffCuti.search') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahun </label>
                            <input name="tahun" type="text" class="form-control"
                                placeholder="Masukan Tahun Contoh = '2012' tanpa tanda petik">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->

@endsection
