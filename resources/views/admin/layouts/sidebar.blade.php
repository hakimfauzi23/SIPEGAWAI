<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-building"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPEGAWAI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pegawai.index') }}">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Data Pegawai</span></a>
    </li> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pegawai" aria-expanded="true"
            aria-controls="pegawai">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Pegawai</span>
        </a>
        <div id="pegawai" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur </h6>
                <a class="collapse-item" href="{{ route('pegawai.index') }}">List Pegawai </a>
                <a class="collapse-item" href="{{ route('pegawai.create') }}">Tambah Pegawai </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jabatan" aria-expanded="true"
            aria-controls="jabatan">
            <i class="fab fa-fw fa-black-tie"></i>
            <span>Jabatan</span>
        </a>
        <div id="jabatan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur </h6>
                <a class="collapse-item" href="{{ route('jabatan.index') }}">List Jabatan </a>
                <a class="collapse-item" href="{{ route('jabatan.create') }}">Tambah Data Jabatan </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#divisi" aria-expanded="true"
            aria-controls="divisi">
            <i class="fas fa-fw fa-braille"></i>
            <span>Divisi</span>
        </a>
        <div id="divisi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur </h6>
                <a class="collapse-item" href="{{ route('divisi.index') }}">List Divisi </a>
                <a class="collapse-item" href="{{ route('divisi.create') }}">Tambah Data Divisi </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#presensi" aria-expanded="true"
            aria-controls="presensi">
            <i class="fas fa-fw fa-braille"></i>
            <span>Presensi</span>
        </a>
        <div id="presensi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur </h6>
                <a class="collapse-item" href="{{ route('presensi.index') }}">Data Presensi Harian </a>
                <a class="collapse-item" href="{{ route('presensi.create') }}">Tambah Data Divisi </a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>





    {{-- <!-- Heading -->
    <div class="sidebar-heading">
        Data Kehadiran Pegawai
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider"> --}}

</ul>
