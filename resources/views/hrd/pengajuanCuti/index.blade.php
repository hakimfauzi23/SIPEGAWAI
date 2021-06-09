@extends('layout.base')


@section('title', 'Data Cuti')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Data Cuti</span>
                    - Pengajuan Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Pengajuan Cuti Pegawai</li>
                {{-- <li class="active">Dashboard</li> --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="panel bg-info">
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
                <em>
                    <h6> Halaman ini menampilkan daftar pengajuan cuti pegawai yang sudah disetujui atasan pegawai,
                        dan langkah selanjutnya harus disetujui oleh HRD.
                        <br>Untuk <b>Menyetujui</b> atau <b>Menolak</b> pengajuan cuti silahkan klik tombol "lihat".
                    </h6>
                </em>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="panel panel-flat">
                <div class="panel-heading">
                </div>

                <div class="panel-body">

                    <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tipe Cuti</th>
                                <th>Tgl Pengajuan</th>
                                <th>Keterangan</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if ($pengajuan->count())
                                @foreach ($pengajuan as $key => $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->pegawai->nama }}</td>
                                        <td>{{ $p->tipe_cuti }}</td>
                                        <td>{{ $p->tgl_pengajuan }}</td>
                                        <td>{{ $p->ket }}</td>
                                        <td class="text-center">
                                            <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                            <a href="{{ route('hrdPengajuanCuti.show', $encyrpt) }}"
                                                class="btn btn bg-info-300"><i class=" icon-eye"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic datatable -->
@endsection
