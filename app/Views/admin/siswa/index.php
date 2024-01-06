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
                        <button class="btn btn-sm btn-primary tambah" onclick="window.location.href='<?= base_url('siswa/tambahSiswa') ?>'">
                            Tambah Data
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="cell-fit">No</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th class="cell-fit">Jenis Kelamin</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_siswa as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['siswa_nis'] ?></td>
                                    <td><?= $value['siswa_nisn'] ?></td>
                                    <td><?= $value['siswa_nama'] ?></td>
                                    <td><?= $value['siswa_jenis_kelamin'] ?></td>
                                    <td class="text-center">
                                        <img class="img-fluid shadow" src="<?= base_url('foto_siswa/' . $value['siswa_foto']) ?>" width="100px">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-info" onclick="window.location.href='<?= base_url('siswa/detailSiswa/') . $value['siswa_nis'] ?>'">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-flat btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $value['siswa_id'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm btn-flat btn-success" data-bs-toggle="modal" data-bs-target="#akun<?= $value['account_id'] ?>">
                                            <i class="fas fa-user-shield"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<?php foreach ($dt_siswa as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['siswa_id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">Hapus Data Siswa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data ini</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='<?= base_url('siswa/deleteData/' . $value['siswa_id']) ?>'">Submit</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Delete -->

<!-- Modal Akun -->
<?php foreach ($dt_siswa as $key => $value) { ?>
    <div class="modal fade" id="akun<?= $value['account_id'] ?>" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Akun Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('siswa/editakunsiswa/' . $value['account_id']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="account_username">Username</label>
                            <input type="text" class="form-control border-secondary px-3 py-4" name="account_username" value="<?= $value['account_username'] ?>" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="account_password">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control border-secondary px-3 py-4" name="account_password" placeholder="Password" id="inputPw" />
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-eye" onclick="togglePw()"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Akun -->
<?= $this->endSection(); ?>