<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<div class="col">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center py-3">
                        <h3 class="font-weight-bolder text-gray-900"><?= $dt_siswa['siswa_nama'] ?></h3>
                        <h6 class="font-italic">@<?= $dt_siswa['account_username'] ?></h6>
                    </div>
                    <div class="form-group" id="pre">
                        <img src="<?= base_url('foto_siswa/') . $dt_siswa['siswa_foto'] ?>" id="gambar_load_edit" class="w-100" style="width: 300px;">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="card-title h3 font-weight-bold text-gray-900">Profil Siswa</div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtnis">NIS</label>
                                <input type="number" min="1" class="form-control px-4" value="<?= $dt_siswa['siswa_nis'] ?>" id="txtnip" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtNisn">NISN</label>
                                <input type="text" class="form-control px-4" value="<?= $dt_siswa['siswa_nisn'] ?>" id="txtNisn" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtTTL">Tempat, Tanggal Lahir</label>
                                <input type="text" class="form-control px-4" value="<?= $dt_siswa['siswa_tempat_lahir'] . ', ' . $dt_siswa['siswa_tanggal_lahir'] ?>" id="txtTTl" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtJk">Jenis Kelamin</label>
                                <input type="text" class="form-control px-4" name="siswa_jenis_kelamin" value="<?= $dt_siswa['siswa_jenis_kelamin'] ?>" id="txtJk" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtAgama">Agama</label>
                                <input type="text" class="form-control px-4" value="<?= $dt_siswa['siswa_agama'] ?>" id="txtAgama" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtTelepon">Telepon</label>
                                <input type="text" class="form-control px-4" value="<?= $dt_siswa['siswa_telepon'] ?>" id="txtTelepon" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtAgama">Alamat</label>
                                <textarea name="" id="" cols="30" rows="3" class="form-control" readonly><?= $dt_siswa['siswa_alamat'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtKelasSekarang">Kelas Sekarang</label>
                                <input type="text" class="form-control px-4" value="<?= $dt_siswa['siswa_kelas_sekarang'] ?>" id="txtKelasSekarang" readonly>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-flat btn-success" data-bs-toggle="modal" data-bs-target="#akun<?= $dt_siswa['siswa_id'] ?>">
                        Ubah Akun
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Akun -->
<div class="modal fade" id="akun<?= $dt_siswa['siswa_id'] ?>" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Akun Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('profil_siswa/update/' . $dt_siswa['account_id']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="account_username">Username</label>
                        <input type="text" class="form-control border-secondary px-3 py-4" name="account_username" id="account_username" value="<?= $dt_siswa['account_username'] ?>" placeholder="Username" required>
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
<!-- End Modal Akun -->
<?= $this->endSection() ?>