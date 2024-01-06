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

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('raport/preview_bio/' . getNisByAccount()) ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Bio</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <?php $listKelas = getAllKelas(); ?>
    <hr class="sidebar-divider my-0">
    <?php foreach ($listKelas as $dtKelas) : ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file-contract"></i>
                <span><?= $dtKelas['kelas_nama'] ?> (<?= $dtKelas['th_nama'] ?>)</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><?= $dtKelas['kelas_nama'] ?> (<?= $dtKelas['th_nama'] ?>)</h6>
                    <a class="collapse-item" href="<?= base_url('raport/preview_raport/' . $dtKelas['gm_kelas_id'] . '/' . $dtKelas['gm_th_id']) . '/1' . '/' . getNisByAccount() ?>">Ganjil</a>
                    <a class="collapse-item" href="<?= base_url('raport/preview_raport/' . $dtKelas['gm_kelas_id'] . '/' . $dtKelas['gm_th_id']) . '/2' . '/' . getNisByAccount() ?>">Genap</a>
                </div>
            </div>
        </li>
    <?php endforeach ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>