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
                                <td>
                                    @if (stripos($p->nama, 'pph') || stripos($p->nama, 'bpjs'))
                                        {{ 'Sesuai UU' }}
                                    @else
                                        @currency($p->jumlah)
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div style="float:left;">
                                        <form method="POST" action="{{ route('potongan.isActive', $encyrpt) }}"
                                            id="formActive">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}


                                            @if ($p->is_active == 1)
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" class="styled" value="0" name="is_active"
                                                        onchange="this.form.submit()" checked>
                                                    Active
                                                </label>
                                            @else
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" class="styled" value="1" name="is_active"
                                                        onchange="this.form.submit()">
                                                    Active
                                                </label>
                                            @endif

                                        </form>
                                    </div>

                                    <div style="width:50%; margin:auto;">
                                        <div style="display:inline-block; width:45%;text-align:center;">
                                            <form method="POST" action="{{ route('potongan.isShown', $encyrpt) }}"
                                                id="formShown">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}


                                                @if ($p->is_shown == 1)
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" class="styled" value="0" name="is_shown"
                                                            onchange="this.form.submit()" checked>
                                                        Shown
                                                    </label>
                                                @else
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" class="styled" value="1" name="is_shown"
                                                            onchange="this.form.submit()">
                                                        Shown
                                                    </label>
                                                @endif

                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td hidden><span class="label label-success">Active</span></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                @if (stripos($p->nama, 'pph') || stripos($p->nama, 'bpjs'))
                                                    <li>'Apabila ingin mematikan hapus centang 'is shown' & 'is active'</li>
                                                @else
                                                    <li><a href="{{ route('potongan.destroy', $encyrpt) }}"><i
                                                                class=" icon-trash"></i> Hapus</a>
                                                    </li>
                                                    <li><a href="{{ route('potongan.edit', $encyrpt) }}"><i
                                                                class=" icon-pencil5"></i> Edit</a>
                                                    </li>
                                                @endif

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
