<?= $this->extend('template/index') ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

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
                                <th>Nip</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_guru as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['guru_nip'] ?></td>
                                    <td><?= $value['guru_nama'] ?></td>
                                    <td><?= $value['guru_email'] ?></td>
                                    <td class="text-center">
                                        <img class="img-fluid shadow" src="<?= base_url('foto_guru/' . $value['guru_foto']) ?>" width="100px">
                                    </td>
                                    <td>

                                        <button class="btn btn-sm btn-flat btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['guru_id'] ?>">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-flat btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $value['guru_id'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm btn-flat btn-success" data-bs-toggle="modal" data-bs-target="#akun<?= $value['guru_id'] ?>">
                                            <i class="fas fa-user-shield"></i>
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
<?php foreach ($dt_guru as $key => $value) { ?>
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLabel">Tambah Data Guru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open_multipart('guru/insertdata') ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nip_guru">NIP Guru</label>
                            <input type="number" min="0" class="form-control px-3" name="guru_nip" id="nip_guru" placeholder="Masukkan NIP" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nama_guru">Nama Guru</label>
                            <input type="text" class="form-control px-3" name="guru_nama" id="nama_guru" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="email_guru">Email Guru</label>
                            <input type="email" class="form-control px-3" name="guru_email" id="email_guru" placeholder="Masukkan Email" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="guru_foto" class="form-label">Foto Guru</label>
                            <input type="file" accept="image/*" class="form-control" name="guru_foto" id="foto" onchange="bacaGambar(event)" required>
                        </div>
                        <div class="col-12" id="pre">
                            <label for="gambar_load">Preview Foto</label><br>
                            <img src="" class="d-flex mx-auto" id="gambar_load" width="250px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <?= form_close() ?>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End of Modal Add -->

<!-- Modal Edit -->
<?php foreach ($dt_guru as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['guru_id'] ?>" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Edit Data Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open_multipart('guru/editdataguru/' . $value['guru_id']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="guru_nip">NIP Guru</label>
                            <input type="number" min="0" class="form-control px-3" name="guru_nip" id="guru_nip" value="<?= $value['guru_nip'] ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="guru_nama">Nama Guru</label>
                            <input type="text" class="form-control px-3" name="guru_nama" id="guru_nama" value=" <?= $value['guru_nama'] ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="guru_email">Email Guru</label>
                            <input type="email" class="form-control px-3" name="guru_email" id="guru_email" value=" <?= $value['guru_email'] ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label>Foto</label>
                                <input id="guru_foto" type="file" accept="image/*" name="guru_foto" class="form-control" onchange="editGambar(event,'#gambar_load_edit')">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group" id="pre">
                                <label>Preview</label><br>
                                <img src="<?= base_url('foto_guru/' . $value['guru_foto']) ?>" id="gambar_load_edit" width="200px">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-black">Submit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End of Modal Edit -->


<!-- Modal Delete -->
<?php foreach ($dt_guru as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['guru_id'] ?>" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Hapus Data Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="fs-6 text-gray-800">"Apakah Anda yakin ingin menghapus data guru dengan nama <b class="text-black text-uppercase">Sumiyati</b> ?"<br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End of Modal Delete -->

<!-- Modal Akun -->
<?php foreach ($dt_guru as $key => $value) { ?>
    <div class="modal fade" id="akun<?= $value['guru_id'] ?>" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Akun Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('guru/editakunGuru/' . $value['account_id']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="account_username">Username</label>
                            <input type="text" class="form-control border-secondary px-3 py-4" name="account_username" id="account_username" value=" <?= $value['account_username'] ?>" required>
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