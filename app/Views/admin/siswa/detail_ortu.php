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
                    <?= form_open('siswa/editdataortu/' . $id_siswa['siswa_id']) ?>
                    <div class="row">
                        <div class="col px-5 py-4 border-right">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="ortu_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control px-3" name="ortu_ayah" id="ortu_ayah" old="<?= old('ortu_ayah') ?>" value="<?= (empty($dt_ortu)) ? '' : $dt_ortu['ortu_ayah'] ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control px-3" name="ortu_ibu" id="ortu_ibu" old="<?= old('ortu_ibu') ?>" value="<?= (empty($dt_ortu)) ? '' : $dt_ortu['ortu_ibu'] ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_alamat">Alamat Orang Tua</label>
                                    <textarea rows="3" class="form-control px-3" name="ortu_alamat" id="ortu_alamat" old="<?= old('ortu_alamat') ?>"><?= (empty($dt_ortu)) ? '' : $dt_ortu['ortu_alamat'] ?></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_telepon">Telepon Orang Tua</label>
                                    <input type="text" inputmode="tel" class="form-control px-3" name="ortu_telepon" id="ortu_telepon" old="<?= old('ortu_telepon') ?>" value="<?= (empty($dt_ortu)) ? '' : $dt_ortu['ortu_telepon'] ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_pekerjaan_ayah">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control px-3" name="ortu_pekerjaan_ayah" id="ortu_pekerjaan_ayah" old="<?= old('ortu_pekerjaan_ayah') ?>" value="<?= (empty($dt_ortu)) ? '' : $dt_ortu['ortu_pekerjaan_ayah'] ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ortu_pekerjaan_ibu">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control px-3" name="ortu_pekerjaan_ibu" id="ortu_pekerjaan_ibu" old="<?= old('ortu_pekerjaan_ibu') ?>" value="<?= (empty($dt_ortu)) ? '' : $dt_ortu['ortu_pekerjaan_ibu'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col px-5 py-4 border-left">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="wali_nama">Nama Wali</label>
                                    <input type="text" class="form-control px-3" name="wali_nama" id="wali_nama" old="<?= old('wali_nama') ?> " value=" <?= (empty($dt_wali)) ? '' : $dt_wali['wali_nama'] ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="wali_alamat">Alamat Wali</label>
                                    <textarea rows="3" class="form-control px-3" name="wali_alamat" id="wali_alamat" old="<?= old('wali_alamat') ?>"><?= (empty($dt_wali)) ? '' : $dt_wali['wali_alamat'] ?></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="wali_telepon">Telepon Wali</label>
                                    <input type="text" inputmode="tel" class="form-control px-3" name="wali_telepon" id="wali_telepon" old="<?= old('wali_telepon') ?>" value=" <?= (empty($dt_wali)) ? '' : $dt_wali['wali_telepon'] ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="wali_pekerjaan">Pekerjaan Wali</label>
                                    <input type="text" class="form-control px-3" name="wali_pekerjaan" id="wali_pekerjaan" old="<?= old('wali_pekerjaan') ?>" value=" <?= (empty($dt_wali)) ? '' : $dt_wali['wali_pekerjaan'] ?>">
                                </div>
                                <div class="col-12">
                                    <button class="w-100 btn btn-sm btn-primary fs-5" type="submit">
                                        Ubah Data Orang Tua
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