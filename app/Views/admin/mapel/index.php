<?= $this->extend('template/index') ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-primary tambah" data-bs-toggle="modal" data-bs-target="#add">
                            Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="cellFit">No</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Kategori</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_mapel as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['mapel_nama'] ?></td>
                                    <td><?= $value['mapel_kategori'] ?> (<?= getCategoryMapel()[$value['mapel_kategori']] ?>)</td>
                                    <td><?= $value['mapel_grade_kelas'] ?></td>
                                    <td><?= $value['mapel_jurusan'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['mapel_id'] ?>">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-flat btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $value['mapel_id'] ?>">
                                            <i class="fas fa-trash"></i>
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

<!-- Modal Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Mata Pelajaran</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('mapel/insertdata') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Mata Pelajaran</label>
                    <input name="txt_nama" class="form-control" placeholder="Nama Mata Pelajaran" required>
                </div>
                <div id="formMapelKategori" class="form-group">
                    <label>Kategori Mapel</label>
                    <select name="txt_kategori" id="mapel_kategori" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach (getCategoryMapel() as $key => $val) : ?>
                            <option value="<?= $key ?>"><?= $key ?> (<?= $val ?>)</option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div id="formMapelKelasGrade" class="form-group">
                    <label>Kategori Kelas</label>
                    <select name="txt_kelas" id="mapel_jurusan" class="form-control">
                        <option value="">--Pilih kelas--</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div id="formMapelJurusan" class="form-group">
                    <label>Kategori Jurusan</label>
                    <select name="txt_jurusan" id="mapel_jurusan" class="form-control">
                        <option value="">--Pilih Jurusan--</option>
                        <option value="TBSM">TBSM</option>
                        <option value="RPL">RPL</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<!-- End Modal Add -->

<!-- Modal Edit -->
<?php foreach ($dt_mapel as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['mapel_id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Mata Pelajaran</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('mapel/editdata/' . $value['mapel_id']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <input name="txt_nama" class="form-control" placeholder="Nama Mata Pelajaran" value="<?= $value['mapel_nama'] ?>" required>
                    </div>
                    <div id="formMapelKategori" class="form-group">
                        <label>Kategori Mapel</label>
                        <select name="txt_kategori" id="mapel_kategori" class="form-control">
                            <option value="">--Pilih Kategori--</option>
                            <option value="A" <?= ($value['mapel_kategori'] == 'A') ? 'selected' : '' ?>>A</option>
                            <option value="B" <?= ($value['mapel_kategori'] == 'B') ? 'selected' : '' ?>>B</option>
                            <option value="C1" <?= ($value['mapel_kategori'] == 'C1') ? 'selected' : '' ?>>C1</option>
                            <option value="C2" <?= ($value['mapel_kategori'] == 'C2') ? 'selected' : '' ?>>C2</option>

                        </select>
                    </div>
                    <div id="formMapelKelasGrade" class="form-group">
                        <label>Kategori Kelas</label>
                        <select name="txt_kelas" id="mapel_kelas_grade" class="form-control">
                            <option value="">--Pilih kelas--</option>
                            <option value="10" <?= ($value['mapel_grade_kelas'] == '10') ? 'selected' : '' ?>>10</option>
                            <option value="11" <?= ($value['mapel_grade_kelas'] == '11') ? 'selected' : '' ?>>11</option>
                            <option value="12" <?= ($value['mapel_grade_kelas'] == '12') ? 'selected' : '' ?>>12</option>

                        </select>
                    </div>
                    <div id="formMapelJurusan" class="form-group">
                        <label>Kategori Jurusan</label>
                        <select name="txt_jurusan" id="mapel_jurusan" class="form-control">
                            <option value="">--Pilih Jurusan--</option>
                            <option value="TBSM" <?= ($value['mapel_jurusan'] == 'TBSM') ? 'selected' : '' ?>>TBSM</option>
                            <option value="RPL" <?= ($value['mapel_jurusan'] == 'RPL') ? 'selected' : '' ?>>RPL</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Edit -->

<!-- Modal Delete -->
<?php foreach ($dt_mapel as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['mapel_id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">Hapus Mata Pelajaran</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data ini</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" onclick="window.location.href='<?= base_url('mapel/deleteData/' . $value['mapel_id']) ?>'">Submit</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Delete -->

<script>
    function setMapelJurusan(code) {
        if (code == "c1" || code == "c2") {
            $("#formMapelKelasGrade").show();
            $("#formMapelJurusan").show();
        } else {
            $("#formMapelKelasGrade").hide();
            $("#formMapelJurusan").hide();
        }
    }
    $("#mapel_kategori").change(function() {
        setMapelJurusan($(this).val().toLowerCase());
    })
    $(document).ready(function() {
        setMapelJurusan($(this).val().toLowerCase());
    })
</script>

<?= $this->endSection(); ?>