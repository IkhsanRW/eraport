<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-2">
                            <img src="<?= base_url('assets/img/bg_login.jpg') ?>" class="card-img-top rounded">
                        </div>
                        <div class="col">
                            <div class="card-title fs-4 fw-bold"><?= $dtGuru['guru_nama'] ?></div>
                            <div class="row mb-3 w-25">
                                <div class="col-6">
                                    <div class="card-text text-muted">NIP GURU :</div>
                                </div>
                                <div class="col-6">
                                    <div class="card-text"><?= $dtGuru['guru_nip'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="cell-fit">No</th>
                                <th>Nama Mapel</th>
                                <th>Kategori</th>
                                <th>Kelas Diajar</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($dtGM as $dt) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $dt['mapel_nama'] ?></td>
                                    <td><?= $dt['mapel_kategori'] ?></td>
                                    <td><?= $dt['kelas_grade'] ?></td>
                                    <td><?= $dt['kelas_jurusan'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-success" onclick="window.location.href = '<?= base_url('penilaian/beri_nilai/' . $dt['gm_id']) ?>'">
                                            Penilaian
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>