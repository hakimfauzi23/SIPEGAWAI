@extends('admin.layouts.base')

@section('page_title', 'List Divisi')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">List Divisi  / </li>
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
            <a href="{{ route('divisi.create') }}" class="btn btn-primary">Tambah Divisi Baru</a>
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
