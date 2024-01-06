<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="cell-fit">No</th>
                                <th>Grade</th>
                                <th>Nama Kelas</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_kelas as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['kelas_grade'] ?></td>
                                    <td><?= $value['kelas_nama'] ?></td>
                                    <td><?= $value['kelas_jurusan'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-primary" onclick="window.location.href='<?= base_url('naikkelas/add_siswa') ?>/<?= $value['kelas_id'] ?>'">
                                            <i class="fas fa-user-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>