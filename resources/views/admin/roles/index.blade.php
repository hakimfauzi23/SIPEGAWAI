@extends('layout.base')


@section('title', 'Manajemen Role')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-key"></i> <span class="text-semibold">Manajemen Role</span>
                    - List Data Role</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Role</li>
                {{-- <li class="active">Dashboard</li> --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Ini adalah halaman yang menampilkan semua role di dalam SIPEGAWAI ini, secara default hanya Super
                        Admin yang bisa mengedit fungsi role.
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
        <div class="col-md-7">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h4 class="panel-title"> Hak Akses </h4>
                    <a href="{{ route('role.create') }}"><i class="icon-file-plus"></i> Tambah Hak Akses Baru</a>
                </div>
                <div class="panel-body">
                    <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama </th>
                                <th hidden>Tipe Cuti</th>
                                <th hidden>Tgl Pengajuan</th>
                                <th hidden>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if ($hak_akses->count())
                                @foreach ($hak_akses as $key => $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                        <li><a href="{{ route('role.show', $encyrpt) }}"><i
                                                                    class="icon-file-eye"></i> Detail </a>
                                                        </li>
                                                        <li><a href="{{ route('role.destroy', $encyrpt) }}"><i
                                                                    class=" icon-trash"></i> Hapus</a>
                                                        </li>
                                                        <li><a href="{{ route('role.edit', $encyrpt) }}"><i
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
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h4 class="panel-title"> Roles </h4>
                    <a href="{{ route('role.create') }}"><i class="icon-file-plus"></i> Tambah Data Role Baru</a>
                </div>
                <div class="panel-body">
                    <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th hidden>Tipe Cuti</th>
                                <th hidden>Tgl Pengajuan</th>
                                <th hidden>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if ($roles->count())
                                @foreach ($roles as $key => $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                        <li><a href="{{ route('role.show', $encyrpt) }}"><i
                                                                    class="icon-file-eye"></i> Detail </a>
                                                        </li>
                                                        <li><a href="{{ route('role.destroy', $encyrpt) }}"><i
                                                                    class=" icon-trash"></i> Hapus</a>
                                                        </li>
                                                        <li><a href="{{ route('role.edit', $encyrpt) }}"><i
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
            </div>
        </div>
    </div>
@endsection
