<?= $this->extend('template/index') ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="row fs-5">
                            <div class="col-2">Kelas</div>
                            <div class="col fw-bold"><?= $dt_kelas['kelas_nama']; ?></div>
                        </div>
                        <div class="row fs-5">
                            <div class="col-2">Wali Kelas</div>
                            <div class="col fw-bold"> <?= (is_null($dt_wali_kelas)) ? 'Belum ditentukan' : $dt_wali_kelas['guru_nama']; ?></div>
                        </div>
                        <div class="row fs-5">
                            <div class="col-2">Tahun Ajaran</div>
                            <div class="col fw-bold"><?= $dt_ta['th_nama']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <th class="cell-fit">No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_siswa as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['siswa_nis'] ?></td>
                                    <td><?= $value['siswa_nama'] ?></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='<?= base_url('raport/preview_bio') ?>/<?= $value['siswa_nis'] ?>'">
                                            <i class="fa fa-user"></i>&ensp;Biodata
                                        </button>
                                        <button class="btn btn-info" onclick="window.location.href='<?= base_url('raport/preview_raport/' . $id_kelas . '/' . $dt_ta['th_id'] . '/1' . '/' . $value['siswa_nis']) ?>'">
                                            <i class="fa fa-file-contract"></i>&ensp;Ganjil
                                        </button>
                                        <button class="btn btn-danger" onclick="window.location.href='<?= base_url('raport/preview_raport/' . $id_kelas . '/' . $dt_ta['th_id'] . '/2' . '/' . $value['siswa_nis']) ?>'">
                                            <i class="fa fa-file-contract"></i>&ensp;Genap
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
<?= $this->endSection(); ?>