@extends('admin.layouts.base')

@section('page_title', 'List Divisi')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('divisi.index') }}">List Divisi </a></li>
            <li class="breadcrumb-item"> Hasil Pencarian </li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">
            @if (session('success_message'))
                <div class="alert alert success">
                    {{ session('success_message') }}
                </div>
            @endif

            <div class="row">
                <div class="col">
                    <a href="{{ route('divisi.create') }}" class="btn btn-primary">Tambah Divisi Baru</a>
                </div>
                <div class="col"></div>
                <div class="col">
                    <form action="{{ route('divisi.search') }}" method="GET" class="form-inline">
                        {{ csrf_field() }}

                        <div class="form-group ml-5">
                            <div class="input-group">
                                <input class="form-control mr-2" type="text" name="cari" placeholder="Cari Divisi .."
                                    value="{{ old('cari') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit">Go!</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="mb-3"></div>
            <table style="text-align:center" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>@sortablelink('id','ID DIVISI')</th>
                        <th>@sortablelink('nm_divisi','DIVISI')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($divisi->count())
                        @foreach ($divisi as $key => $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->nm_divisi }}</td>
                                <td>
                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                    <a href="{{ route('divisi.edit', $encyrpt) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('divisi.destroy', $encyrpt) }}"
                                        class="btn btn-danger delete-confirm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <br />
            <div class="pagenation">

                Page : {{ $divisi->currentPage() }}
                || Total Data : {{ $divisi->total() }}
                {{ $divisi->links() }}

            </div>
        </div>

    </div>


@endsection
