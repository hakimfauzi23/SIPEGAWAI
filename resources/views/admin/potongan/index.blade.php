@extends('layout.base')

@section('title', 'Data Potongan')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-cash3"></i> <span class="text-semibold">Data Gaji</span>
                    - List Data Potongan</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Potongan</li>
                {{-- <li class="active">Dashboard</li> --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Pada halaman ini terdapat list daftar potongan gaji yang ada di dalam perusahaan ini. masing-masing
                    potongan bisa
                    dihapus dan diedit.
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
            <a href="{{ route('potongan.create') }}"><i class="icon-file-plus"></i> Tambah Data Potongan </a>
        </div>

        <div class="panel-body">

            <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama </th>
                        <th> Jumlah </th>
                        <th> Status</th>
                        <th hidden></th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @if ($potongan->count())
                        @foreach ($potongan as $key => $p)
                            <?php $encyrpt = Crypt::encryptString($p->id); ?>
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $p->nama }}</td>
                                <td> @currency($p->jumlah)</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('potongan.active', $encyrpt) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        @if ($p->is_active == 1)
                                            <input type="checkbox" name="is_active" value="0" checked
                                                onchange="this.form.submit()">
                                        @else

                                            <input type="checkbox" name="is_active" value="1"
                                                onchange="this.form.submit()">
                                        @endif
                                    </form>
                                </td>
                                <td hidden><span class="label label-success">Active</span></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{ route('potongan.destroy', $encyrpt) }}"><i
                                                            class=" icon-trash"></i> Hapus</a>
                                                </li>
                                                <li><a href="{{ route('potongan.edit', $encyrpt) }}"><i
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
    <!-- /basic datatable -->

@endsection
