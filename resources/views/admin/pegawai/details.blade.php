@extends('layout.base')


@section('title', 'Details Data Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-users4"></i> <span class="text-semibold">Data Pegawai</span>
                    - Details Data Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('pegawai.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Pegawai
                    </a>
                </li>
                <li class="active">Details Data Pegawai {{ 'ID : ' . $pegawai->id }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="col-md-4">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="text-center">
                    @php $path =Storage::url('images/'.$pegawai->path); @endphp
                    <img src="{{ url($path) }}"
                        onerror="this.onerror=null; this.src='{{ URL::to('/admin/assets/images/brands/user.jpeg') }}'"
                        alt="Foto Profil" width="160">
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading bg-success">
                <h5 class="panel-title">Data Akun Sistem Informasi</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-xs">
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td>{{ $pegawai->role->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $pegawai->email }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>


        <div class="panel">
            <div class="panel-heading bg-info">
                <h5 class="panel-title">Riwayat Jabatan</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-xs">
                        @foreach ($riwayat_jabatan as $p)
                            <tr>
                                <td>{{ $p->jabatan->nm_jabatan }}</td>
                                <td>{{ date('M-Y', strtotime($p->tgl_mulai)) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading bg-info">
                <h5 class="panel-title">Riwayat Divisi</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-xs">
                        @foreach ($riwayat_divisi as $p)
                            <tr>
                                <td>{{ $p->divisi->nm_divisi }}</td>
                                <td>{{ date('M-Y', strtotime($p->tgl_mulai)) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-8">
        <div class="panel">
            <div class="panel-heading bg-teal-400">
                <h5 class="panel-title">Data Personal</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                {{-- <legend class="text-semibold"><i class="icon-reading position-left"></i> Data Personal
                        </legend> --}}
                <div class="table-responsive">
                    <table class="table table-xs">
                        <tr>
                            <td>NIK</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->nik }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->nama }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->jk }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->tempat_lahir }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td class="text-center">:</td>
                            <td>{{ date('d-M-Y', strtotime($pegawai->tgl_lahir)) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->agama }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->status }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Anak</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->jml_anak }}
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat KTP</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->alamat_ktp }}
                            </td>
                        </tr>

                        <tr>
                            <td>Alamat Domisili</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->alamat_dom }}
                            </td>
                        </tr>


                    </table>
                </div>

            </div>

        </div>

        <div class="panel">
            <div class="panel-heading bg-orange-400">
                <h5 class="panel-title">Data Kepegawaian</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-xs">
                        <tr>
                            <td>ID</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->id }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->jabatan->nm_jabatan }}</td>
                        </tr>
                        <tr>
                            <td>Divisi</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->divisi->nm_divisi }}</td>
                        </tr>
                        <tr>
                            <td>Atasan</td>
                            <td class="text-center">:</td>
                            <td><?php if ($pegawai->id_atasan == 0) {
                                echo 'Belum / Tidak ada atasan.';
                                } else {
                                echo $pegawai->bawahan->nama;
                                } ?>
                        </tr>
                        <tr>
                            <td>Bekerja Sejak</td>
                            <td class="text-center">:</td>
                            <td>{{ date('d-M-Y', strtotime($pegawai->tgl_masuk)) }}</td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td class="text-center">:</td>
                            <td>{{ $pegawai->no_hp }}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
