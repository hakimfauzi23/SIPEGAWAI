<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/landingPage">
                <img src="{{ URL::to('/arclabs') }}/img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a class="<?php if ($currentPage == 'home') {
                        echo 'active';
                    } ?>" href="/landingPage">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Cuti
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Form Pengajuan </a>
                            <a class="dropdown-item" href="#">Status Pengajuan</a>
                            <a class="dropdown-item" href="#">Riwayat Pengajuan</a>
                        </div>

                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle <?php if ($currentPage == 'HRD') {
                            echo 'active';
                        } ?>" href="#" id="navbardrop" data-toggle="dropdown">
                            HRD
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('hrdPegawai.index') }}">Data Pegawai</a>
                            <a class="dropdown-item" href="#">Data Cuti</a>
                            <a class="dropdown-item" href="#">Data Presensi</a>
                        </div>
                    </li>
                    <li><a class="" href="projects.html">Profil</a></li>

                </ul>
            </div>
        </div>
    </nav>
</header>
