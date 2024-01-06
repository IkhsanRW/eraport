<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800"><?= $title_content ?></div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <div class="fs-5 text-white fw-bold">Data Orang Tua</div>
                </div>
                <div class="card-body p-0">
                    <?= form_open('siswa/insertortu/') ?>
                    <div class="row">
                        <div class="col px-5 py-4 border-right">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="ortu_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control px-3" name="ortu_ayah" id="ortu_ayah" old="<?= old('ortu_ayah') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control px-3" name="ortu_ibu" id="ortu_ibu" old="<?= old('ortu_ibu') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_alamat">Alamat Orang Tua</label>
                                    <textarea rows="3" class="form-control px-3" name="ortu_alamat" id="ortu_alamat" old="<?= old('ortu_alamat') ?>" placeholder="" required></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_telepon">Telepon Orang Tua</label>
                                    <input type="text" inputmode="tel" class="form-control px-3" name="ortu_telepon" id="ortu_telepon" old="<?= old('ortu_telepon') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_pekerjaan_ayah">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control px-3" name="ortu_pekerjaan_ayah" id="ortu_pekerjaan_ayah" old="<?= old('ortu_pekerjaan_ayah') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_pekerjaan_ibu">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control px-3" name="ortu_pekerjaan_ibu" id="ortu_pekerjaan_ibu" old="<?= old('ortu_pekerjaan_ibu') ?>" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col px-5 py-4 border-left">
                            <div class="alert alert-warning mb-3" role="alert">
                                <div><i class="fas fa-exclamation-triangle"></i>&ensp;<b>Perhatian</b></div>
                                <div class="text-justify pt-1">
                                    Jika Anda tidak memiliki Wali/tidak tinggal bersama Wali maka form di bawah <b>tidak wajib</b> diisi.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="wali_nama">Nama Wali</label>
                                    <input type="text" class="form-control px-3" name="wali_nama" id="wali_nama" old="<?= old('wali_nama') ?>" placeholder="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="wali_alamat">Alamat Wali</label>
                                    <textarea rows="3" class="form-control px-3" name="wali_alamat" id="wali_alamat" old="<?= old('wali_alamat') ?>" placeholder=""></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="wali_telepon">Telepon Wali</label>
                                    <input type="text" inputmode="tel" class="form-control px-3" name="wali_telepon" id="wali_telepon" old="<?= old('wali_telepon') ?>" placeholder="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="wali_pekerjaan">Pekerjaan Wali</label>
                                    <input type="text" class="form-control px-3" name="wali_pekerjaan" id="wali_pekerjaan" old="<?= old('wali_pekerjaan') ?>" placeholder="">
                                </div>
                                <div class="col-12">
                                    <button class="w-100 btn btn-sm btn-primary fs-5" type="submit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>