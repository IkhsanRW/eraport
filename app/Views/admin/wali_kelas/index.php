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
                                <th class="cellFit">No</th>
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
                                        <?php if (empty($dt_wali_kelas[$value['kelas_id']])) : ?>
                                            <button class="btn btn-sm btn-flat btn-primary btn-add-wali-kelas" data-bs-toggle="modal" data-bs-target="#add_wali" data-content="<?= $value['kelas_id'] ?>">
                                                <i class="fas fa-user-plus"></i>
                                            </button>
                                        <?php else : ?>
                                            <span class="btn-add-wali-kelas" data-bs-toggle="modal" data-bs-target="#add_wali" data-content="<?= $value['kelas_id'] ?>" style="cursor: pointer;">
                                                <?= $dt_wali_kelas[$value['kelas_id']]['guru_nama'] ?>
                                            </span>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Wali Kelas -->
    <form action="<?= base_url('kelas/ubahwali') ?>" method="post">
        <div class="modal fade" id="add_wali" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="add_waliLabel">Pilih Wali Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="text-uppercase">
                                <tr>
                                    <th class="cell-fit">*</th>
                                    <th>NIP</th>
                                    <th>Nama Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dt_guru as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <input class="btn-check" type="radio" name="pilih_wali" id="pilih_wali<?= $value['guru_id'] ?>" value="<?= $value['guru_id'] ?>" required>
                                            <label class="btn btn-outline-danger" for="pilih_wali<?= $value['guru_id'] ?>">
                                                Pilih
                                            </label>
                                        </td>
                                        <td><?= $value['guru_nip'] ?></td>
                                        <td><?= $value['guru_nama'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <input id="selectedkelas" type="hidden" name="selectedkelas" value="">
    </form>
</div>

<script>
    document.querySelectorAll('.btn-add-wali-kelas').forEach(element => {
        element.onclick = function() {
            document.getElementById('selectedkelas').value = element.dataset.content;
        }
    });
</script>

<?= $this->endSection() ?>