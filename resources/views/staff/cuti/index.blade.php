@extends('layout.base')


@section('title', 'Riwayat Cuti')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user"></i> <span class="text-semibold">Menu Staff</span>
                    - Riwayat Pengajuan Cuti</h4>
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
    <div class="row">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Pada halaman ini terdapat riwayat pengajuan cuti anda tahun ini. semua riwayat pengajuan cuti dari
                        yang manual
                        hingga yang diajukan oleh HRD seperti cuti bersama akan tampil di sini.
                        <b> Bisa dirubah untuk tahun riwayat cuti dengan mengklik icon </b> <i class=" icon-more2"></i>
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
                    <thead class="bg-primary">
                        <tr>
                            <th>No</th>
                            <th>Tipe Cuti</th>
                            <th>Tgl Pengajuan</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th hidden>Status</th>
                            <th hidden>Status</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @if ($cuti->count())
                            @foreach ($cuti as $key => $p)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $p->tipe_cuti }}</td>
                                    <td>{{ date('d-M-Y', strtotime($p->tgl_pengajuan)) }}</td>
                                    <td>{{ date('d-M-Y', strtotime($p->tgl_mulai)) }}</td>
                                    <td>{{ date('d-M-Y', strtotime($p->tgl_selesai)) }}</td>
                                    <td hidden>{{ date('d-M-Y', strtotime($p->tgl_selesai)) }}</td>
                                    <td hidden>{{ date('d-M-Y', strtotime($p->tgl_selesai)) }}</td>
                                    <td class="text-center"><span <?php if ($p->status == 'Disetujui HRD' ||
                                            $p->status == 'Disetujui Atasan') {
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
