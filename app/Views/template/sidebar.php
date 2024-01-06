<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <!-- <div class="sidebar-brand-icon"></div> -->
        <div class="sidebar-brand-text mx-auto fs-4">E-Raport</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider mb-3">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master</h6>
                <a class="collapse-item" href="<?= base_url('kelas') ?>">Kelas</a>
                <a class="collapse-item" href="<?= base_url('kelas/waliKelas') ?>">Wali Kelas</a>
                <a class="collapse-item" href="<?= base_url('guru') ?>">Guru</a>
                <a class="collapse-item" href="<?= base_url('siswa') ?>">Siswa</a>
                <a class="collapse-item" href="<?= base_url('mapel') ?>">Mapel</a>
                <a class="collapse-item" href="<?= base_url('tahun_ajaran') ?>">Tahun Ajaran</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-school"></i>
            <span>Data Akademik</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Akademik</h6>
                <a class="collapse-item" href="<?= base_url('kelas/waliKelas') ?>">Wali Kelas</a>
                <a class="collapse-item" href="<?= base_url('gurumapel') ?>">Guru Mapel</a>
                <a class="collapse-item" href="<?= base_url('naikkelas') ?>">Kenaikan Kelas</a>
                <a class="collapse-item" href="<?= base_url('lulus') ?>">Kelulusan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('raport') ?>">
            <i class="fas fa-fw fa-passport"></i>
            <span>Raport</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>