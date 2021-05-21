@extends('layout.base')


@section('title', 'Slip Gaji Tahun Ini')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-cash3"></i> <span class="text-semibold">Data Gaji</span>
                    - Data Slip Gaji Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ route('gaji.index') }}"><i class="active icon-home2 position-left"></i> List
                        Data
                        Pegawai</a></li>
                <li class="active">Data Slip Gaji</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Di halaman ini terdapat daftar slip gaji pegawai yaitu berupa file yang bisa di download.<br>
                    anda bisa menambahkan slip gaji pegawai untuk bulan ini maupun bulan depan. dengan memilih link "Tambah
                    Slip Gaji".
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-heading">
            <?php ?>
            <a href="{{ route('gaji.createData', $id) }}"><i class="icon-file-plus"></i> Tambah Slip Gaji</a>
        </div>

        <div class="panel-body">
            {{-- <div class="panel-group" id="accordion-styled">
                @if ($slipGaji->count())
                    <?php
                    $i = 1;
                    $x = 1;
                    ?>
                    @foreach ($slipGaji as $key => $p)
                        <div class="panel">
                            <div class="panel-heading bg-teal">
                                <h6 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-styled"
                                        href="{{ '#accordion-styled-group' . $x++ }}">{{ date('F Y', strtotime($p->tanggal)) }}</a>
                                </h6>
                            </div>
                            <div id="{{ 'accordion-styled-group' . $i++ }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php $encPath = Crypt::encryptString($p->path); ?>
                                    <a href="{{ route('gaji.download', $encPath) }}"> Link Download Slip Gaji di Sini!</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div> --}}

            <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Informasi Slip Gaji</th>
                        <th>Status</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @if ($slipGaji->count())
                        @foreach ($slipGaji as $key => $p)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ 'Periode : ' . date('F Y', strtotime($p->tanggal)) }}
                                    <br>
                                    {{ 'Nama File : ' . $p->path }}

                                </td>
                                <td>
                                    @if ($p->is_sent == 0)
                                        <span class="label bg-danger">Slip Gaji Belum Dikirim</span>
                                    @else
                                        <span class="label bg-success">{{ 'Dikirim Tanggal : ' . $p->dikirim_tgl }}</span>
                                    @endif

                                </td>
                                <td hidden></td>
                                <td hidden><span class="label label-success">Active</span></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <?php
                                                $enc_path = Crypt::encryptString($p->path);
                                                $enc_id = Crypt::encryptString($p->id);

                                                // $id_peg = Crypt::decryptString($id);
                                                ?>
                                                <li><a
                                                        href="{{ route('gaji.send', ['id_pegawai' => $id, 'id_gaji' => $enc_id]) }}"><i
                                                            class="icon-envelop2"></i> Kirim</a>
                                                </li>
                                                <li><a href="{{ route('gaji.download', $enc_path) }}"><i
                                                            class=" icon-download"></i> Download</a>
                                                </li>
                                                <li><a href="{{ route('gaji.destroy', $enc_id) }}"><i
                                                            class=" icon-trash"></i> Hapus</a>
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
    <!-- /basic datatable -->

@endsection
