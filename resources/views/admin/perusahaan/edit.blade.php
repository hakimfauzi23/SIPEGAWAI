@extends('layout.base')

@section('title', 'Manajemen Perusahaan')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-highlight"></i> <span class="text-semibold">Manajemen Informasi Perusahaan</span></h4>
            </div>

        </div>

    </div>
@endsection

@section('content')

    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Halaman ini berguna apabila anda ingin mengubah informasi perusahaan yang berada di dalam aplikasi ini.
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>
    <?php $id = Crypt::encryptString($perusahaan->id); ?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data"
        action="{{ route('perusahaan.update', $id) }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col">
                    <legend class="text-semibold"><i class="icon-office position-left"></i> Informasi
                        Perusahaan
                    </legend>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">Nama Perusahaan</label>
                            <div class="col-lg-10">
                                <input type="text" name="nama" value="{{ $perusahaan->nama }}" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">No. Telp</label>
                            <div class="col-lg-10">
                                <input type="text" name="no_telp" value="{{ $perusahaan->no_telp }}" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">Email Perusahaan</label>
                            <div class="col-lg-10">
                                <input type="text" name="email_public" value="{{ $perusahaan->email_public }}"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">Kota / Kabupaten Perusahaan</label>
                            <div class="col-lg-10">
                                <input type="text" name="kota" placeholder="digunakan untuk keperluan surat menyurat"
                                    class="form-control" value="{{ $perusahaan->kota }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">Alamat Perusahaan</label>
                            <div class="col-lg-10">
                                <textarea rows="5" cols="5" class="form-control" name="alamat"
                                    placeholder="isi alamat perusahaan tanpa kota"> {{ $perusahaan->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">Logo Perusahaan</label>
                            <div class="col-lg-10">
                                @php $path =Storage::url('images/'.$perusahaan->path_logo); @endphp
                                <img style="display: block;
                                                max-width:230px;
                                                min-height:150px;
                                                max-height:95px;
                                                width: auto;
                                                height: auto;" src="{{ url($path) }}">
                                <input type="file" id="myFile" name="path_logo">
                                <input type="hidden" name="logo_lama" value="{{ $perusahaan->path_logo }}">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <legend class="text-semibold"><i class="icon-mail5 position-left"></i> Email Untuk
                        Aplikasi
                    </legend>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">Email</label>
                            <div class="col-lg-10">
                                <input type="text" name="email_private" value="{{ $perusahaan->email_private }}"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-lg-2 text-semibold">Password Email</label>
                            <div class="col-lg-10">
                                <input type="text" name="password"
                                    placeholder=" Kosongi apabila tidak mengubah alamat e-mail . . ." class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-bold text-center">
                    Email untuk aplikasi sistem ini wajib diatur seperti pada gambar berikut! <a
                        href="https://i.postimg.cc/YSnTPQSd/Screenshot-from-2021-06-17-14-41-01.png" target="_blank">
                        Link</a>
                </div>


                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Submit form <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /2 columns form -->

@endsection
