@extends('layout.base')


@section('title', 'Manajemen Role dan Menu')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-key"></i> <span class="text-semibold">Manajemen Role & Menu</span>
                    - Role dan Menu</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> Role & Menu</li>
                {{-- <li class="active">Dashboard</li> --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Ini adalah halaman yang menampilkan semua role di dalam SIPEGAWAI ini, secara default hanya
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

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">Data Menu </h4>
            <a href="{{ route('manajemen.createMenu') }}"><i class="icon-file-plus"></i> Tambah Menu Baru</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Data Menu</th>
                        <th>Parent Menu</th>
                        <th>Hak Akses</th>
                        <th hidden>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @if ($menus->count())
                        @foreach ($menus as $key => $p)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $p->judul }}
                                    <br />
                                    {{ 'URL : ' . $p->url }}
                                    <br />
                                    @if ($p->icon != null)
                                        {{ 'Kode Icon : ' . $p->icon }} = <i class="{{ $p->icon }}"></i>
                                    @else
                                        {{ 'Tidak ada menu icon' }}
                                    @endif
                                </td>
                                <td>
                                    @if ($p->id_parent != null)
                                        <span class="badge bg-success">
                                            {{ $p->parent->judul }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            {{ 'Tidak ada Parent Menu / Independen' }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $p->hak_akses->name }}
                                </td>
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
                                                <li><a href="{{ route('manajemen.destroyMenu', $encyrpt) }}"><i
                                                            class=" icon-trash"></i> Hapus</a>
                                                </li>
                                                <li><a href="{{ route('manajemen.editMenu', $encyrpt) }}"><i
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

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title"> Data Role </h4>
            <a href="{{ route('role.create') }}"><i class="icon-file-plus"></i> Tambah Data Role Baru</a>
        </div>
        <div class="panel-body table-responsive">
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
                                <td>{{ $p->name }}
                                </td>
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
@endsection
