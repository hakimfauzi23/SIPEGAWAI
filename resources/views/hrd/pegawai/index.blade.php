@extends('layout.base')


@section('title', 'Data Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-users4"></i> <span class="text-semibold">Pegawai</span>
                    - List Data Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Pegawai</li>
                {{-- <li class="active">Dashboard</li> --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- Basic datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <a href="{{ route('hrdPegawai.create') }}"><i class="icon-file-plus"></i> Tambah Pegawai Baru</a>
            {{-- <h5 class="panel-title">List Data Pegawai</h5> --}}
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>


        <table class="table datatable-basic table-bordered table-striped table-hover">
            <thead class="bg-primary-300">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th hidden>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($pegawai->count())
                    @foreach ($pegawai as $key => $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jabatan->nm_jabatan }}</td>
                            <td>{{ $p->divisi->nm_divisi }}</td>
                            <td hidden><span class="label label-success">Active</span></td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                            <li><a href="{{ route('hrdPegawai.show', $encyrpt) }}"><i
                                                        class="icon-file-eye"></i> Detail </a>
                                            </li>
                                            <li><a href="{{ route('hrdPegawai.destroy', $encyrpt) }}"><i
                                                        class=" icon-trash"></i> Hapus</a>
                                            </li>
                                            <li><a href="{{ route('hrdPegawai.edit', $encyrpt) }}"><i
                                                        class=" icon-pencil5"></i> Edit</a>
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
    <!-- /basic datatable -->

@endsection
