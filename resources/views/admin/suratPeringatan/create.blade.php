@extends('layout.base')


@section('title', 'Tambah Data Presensi')


@section('content_header')
    <style>
        #list_item li {
            margin: 12px 0;
        }

    </style>
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-file-text2"></i> <span class="text-semibold">Surat Peringatan</span>
                    - Buat Surat Peringatan</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('suratPeringatan.index') }}"> <i class="active icon-home2 position-left"></i>
                        List Data Surat Peringatan
                    </a>
                </li>
                <li class="active">Buat Surat Peringatan </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>
                    Halaman ini digunakan untuk membuat surat peringatan yang nanti hasil akhirnya merupakan dokumen PDF
                    yang akan dikirimkan ke Email Pegawai.
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="panel panel-flat">
        <div class="panel-body">

            <div class="row">
                <form action="{{ route('suratPeringatan.store') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="text-semibold">Pegawai</label>
                                <select class="select" name="id_pegawai" data-placeholder = "Pilih Pegawai">
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($pegawai as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_pegawai'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_pegawai') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-semibold">Tingkat/SP</label>
                                <select class="select" name="tingkat" data-placeholder = "Pilih Tingkatan / SP Ke - ">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="I">SP-I</option>
                                    <option value="II">SP-II</option>
                                    <option value="III">SP-III</option>
                                </select>

                                @if ($errors->has('tingkat'))
                                    <div class="text-danger">
                                        {{ $errors->first('tingkat') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="text-semibold">Pelanggaran</label>
                        <table border="0" class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <td><input type="text" name="pelanggaran[]"
                                        placeholder="Contoh : Dikarenakan Saudara Sudah Terlambat lebih dari 3X.,Kinerja Saudara Tidak Sesuai Target,dll."
                                        class="form-control" /></td>
                                <td class="text-center"><button type="button" name="add" id="add-btn"
                                        class="btn btn-success">Tambah</button>
                                </td>
                            </tr>
                        </table>

                        @if ($errors->has('pelanggaran[]'))
                            <div class="text-danger">
                                {{ $errors->first('pelanggaran[]') }}
                            </div>
                        @endif
                    </div>

                    <div class="">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('custom_script')
    <script type="text/javascript">
        var i = 1;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr><td><input type="text" name="pelanggaran[]" placeholder="Masukan Pelanggaran yang Ke-' +
                i +
                '" class="form-control" /></td><td class="text-center"><button type="button" class="btn btn-danger remove-tr">Hapus</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

    </script>

@endsection
