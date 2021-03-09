@extends('user.layouts.base')

@section('title', 'Data Pegawai')

@section('content')

    <!-- Start top-section Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center text-center banner-content">
                <div class="col-lg-12">
                    <h1 class="text-white">Pengajuan Cuti Pegawai</h1>
                    <p>Memempermudah HRD untuk mengetahui pengajuan cuti yang belum disetujui atau baru dibuat. </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-section Area -->




    <section class="about-area section-gap">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Pengajuan Cuti </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            @if (session('success_message'))
                <div class="alert alert success">
                    {{ session('success_message') }}
                </div>
            @endif
            <div class="mb-3"></div>
            <table style="text-align:center" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>@sortablelink('id','ID CUTI')</th>
                        <th>@sortablelink('nama','NAMA ')</th>
                        <th>@sortablelink('tgl_pengajuan','TGL PENGAJUAN')</th>
                        <th>@sortablelink('tipe_cuti','TIPE')</th>
                        <th>@sortablelink('ket','KET')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cuti->count())
                        @foreach ($cuti as $key => $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->pegawai->nama }}</td>
                                <td>{{ $p->tgl_pengajuan }}</td>
                                <td>{{ $p->tipe_cuti }}</td>
                                <td>{{ $p->ket }}</td>
                                <td>
                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>

                                    <form method="post" action="{{ route('hrdCuti.keputusan', $encyrpt) }}">

                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <button class="btn btn-success approve-confirm" name="status" type="submit"
                                            value="Disetujui"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger" name="status" type="submit" value="Ditolak"><i
                                                class="fa fa-times" aria-hidden="true"></i></button>
                                        <a href="{{ route('hrdCuti.detailPengajuan', $encyrpt) }}" class="btn btn-info"><i
                                                class="fa fa-info" aria-hidden="true"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <br />
            <div class="pagenation">

                Page : {{ $cuti->currentPage() }}
                || Total Data : {{ $cuti->total() }}
                {{ $cuti->appends(\Request::except('page'))->render() }}

            </div>
        </div>
    </section>


@endsection
