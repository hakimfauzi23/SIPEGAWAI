@extends('admin.layouts.base')

@section('page_title', 'Details Pegawai')
@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">List Pegawai</a></li>
            <li class="breadcrumb-item"> {{ $pegawai->id . '-' . $pegawai->nama }} </li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        @php $path =Storage::url('images/'.$pegawai->path); @endphp
                        <img src="{{ url($path) }}" alt="Foto Profil" width="150">
                        <div class="mt-3">
                            <p class="h3 mb-1">{{ $pegawai->jabatan->nm_jabatan }}</p>
                            <p class="text-muted h5 ">Divisi {{ $pegawai->divisi->nm_divisi }}</p>

                            <?php $encyrpt = Crypt::encryptString($pegawai->id); ?>
                            <a href="{{ route('pegawai.edit', $encyrpt) }}" class="btn btn-success">Edit
                                Biodata</a>
                            <a href="{{ route('pegawai.destroy', $encyrpt) }}" class="btn btn-danger delete-confirm">Hapus
                                Biodata</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-left-success shadow mt-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-person-badge" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path
                                    d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z" />
                            </svg> ID Pegawai </h6>
                        <span class="text-secondary">{{ $pegawai->id }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-link-45deg" viewBox="0 0 24 24">
                                <path
                                    d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                <path
                                    d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                            </svg>Role</h6>
                        <span class="text-secondary">{{ $pegawai->role->nm_role }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-telephone" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                            </svg>No. HP</h6>
                        <span class="text-secondary">{{ $pegawai->no_hp }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-envelope-open" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z" />
                            </svg>Email</h6>
                        <span class="text-secondary">{{ $pegawai->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-key" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">>
                                <path
                                    d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>Password</h6>
                        <span class="text-secondary">{{ $pegawai->password }}</span>
                    </li>
                </ul>
            </div>


        </div>

        <div class="col-md-8">
            <div class="card border-left-warning shadow mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Nomor Induk Kependudukan </h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->nik }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Nama Lengkap</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->nama }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Jenis Kelamin</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->jk }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Agama</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->agama }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Tempat Lahir</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->tempat_lahir }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ date('d-M-Y', strtotime($pegawai->tgl_lahir)) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Alamat KTP</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->alamat_ktp }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Alamat Domisili</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->alamat_dom }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Status</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->status }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Jumlah Anak</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ $pegawai->jml_anak }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="mb-0">Bekerja Sejak</h6>
                        </div>
                        <div class="col-sm-6 text-secondary text-right">
                            {{ date('d-M-Y', strtotime($pegawai->tgl_masuk)) }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                    <div class="card border-left-secondary shadow h-100">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-3">Riwayat Jabatan (<a
                                    href="{{ route('riwayatJabatan.show', $encyrpt) }}">edit</a>)</h6>
                            <ul class="list-group list-group-flush">
                                @foreach ($riwayat_jabatan as $i)
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6> {{ $i->jabatan->nm_jabatan }} </h6>
                                        <span class="text-secondary">{{ date('M y', strtotime($i->tgl_mulai)) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="card border-left-secondary shadow h-100">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-3">Riwayat Divisi (<a href="#">edit</a>)</h6>
                            <ul class="list-group list-group-flush">
                                @foreach ($riwayat_divisi as $i)
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6> {{ $i->divisi->nm_divisi }} </h6>
                                        <span class="text-secondary">{{ date('M y', strtotime($i->tgl_mulai)) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
