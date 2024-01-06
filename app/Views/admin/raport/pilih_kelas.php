<?= $this->extend('template/index') ?>
<?= $this->section('content'); ?>
<?php
$colorList = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-dark'];
$iconList = ['fa-computer', 'fa-computer', 'fa-computer', 'fa-motorcycle', 'fa-motorcycle', 'fa-motorcycle'];
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php $i = 0; ?>
                        <?php foreach ($dt_kelas as $key => $value) { ?>
                            <div class="col-2">
                                <a href="<?= base_url('raport/detail_kelas') ?>/<?= $value['kelas_id'] ?>/<?= $dt_ta['th_id'] ?>" class="btn <?= $colorList[$i] ?> btn-icon-split btn-lg w-100 text-white">
                                    <span class="icon text-white-50 me-auto py-3">
                                        <i class="fas <?= $iconList[$i] ?>"></i>
                                    </span>
                                    <span class="text text-uppercase fw-bold me-auto my-auto"><?= $value['kelas_nama'] ?></span>
                                </a>
                            </div>
                            <?php $i++; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>