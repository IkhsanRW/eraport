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
                    <div class="fs-5 text-white fw-bold">Data Siswa</div>
                </div>
                <div class="card-body p-0">
                    <?= form_open_multipart('siswa/insertdata/') ?>
                    <div class="row">
                        <div class="col px-5 py-4 border-right">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="txt_nama">Nama Lengkap</label>
                                    <input type="text" class="form-control px-3" name="txt_nama" id="txt_nama" value="<?= old('txt_nama') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_nis">Nomor Induk Siswa (NIS)</label>
                                    <input type="number" min="0" class="form-control px-3" name="txt_nis" id="txt_nis" value="<?= old('txt_nis') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_nisn">Nomor Induk Siswa Nasional (NISN)</label>
                                    <input type="number" min="0" class="form-control px-3" name="txt_nisn" id="txt_nisn" value="<?= old('txt_nisn') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_tempat_lahir">Tempat Lahir</label>
                                    <!-- Tempat lahir pakai select? input manual? -->
                                    <input type="text" class="form-control px-3" name="txt_tempat_lahir" id="txt_tempat_lahir" value="<?= old('txt_tempat_lahir') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control px-3 eraport-date" name="txt_tanggal_lahir" id="txt_tanggal_lahir" value="<?= old('txt_tanggal_lahir') ?>" placeholder="dd/mm/yyyy" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Jenis Kelamin</label>
                                    <div class="row">
                                        <div class="col pe-2">
                                            <input class="btn-check" type="radio" name="txt_jenis_kelamin" value="Laki-Laki" id="txt_laki">
                                            <label class="btn btn-outline-danger w-100" for="txt_laki">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="col ps-2">
                                            <input class="btn-check" type="radio" name="txt_jenis_kelamin" value="Perempuan" id="txt_perempuan">
                                            <label class="btn btn-outline-danger w-100" for="txt_perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_agama">Agama</label>
                                    <select name="txt_agama" class="form-control">
                                        <option value="" class="text-center">--Pilih Agama--</option>
                                        <?php foreach ($agama as $dt) : ?>
                                            <option value="<?= $dt ?>"><?= $dt ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_status_keluarga">Status Dalam Keluarga</label>
                                    <input type="text" class="form-control px-3" name="txt_status_keluarga" id="txt_status_keluarga" value="<?= old('txt_status_keluarga') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_anak_ke">Anak ke-</label>
                                    <input type="number" min="1" class="form-control px-3" name="txt_anak_ke" id="txt_anak_ke" value="<?= old('txt_anak_ke') ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_alamat">Alamat Siswa</label>
                                    <textarea rows="3" class="form-control px-3" name="txt_alamat" id="txt_alamat" placeholder="" required><?= old('txt_alamat') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col px-5 py-4 border-left">
                            <div class="col-12 mb-3">
                                <label for="txt_telepon">Telepon</label>
                                <input type="text" inputmode="tel" class="form-control px-3" name="txt_telepon" id="txt_telepon" value="<?= old('txt_telepon') ?>" placeholder="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_sekolah_asal">Nama Sekolah Asal</label>
                                <input type="text" class="form-control px-3" name="txt_sekolah_asal" id="txt_sekolah_asal" value="<?= old('txt_sekolah_asal') ?>" placeholder="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_alamat_sekolah_asal">Alamat Sekolah Asal</label>
                                <textarea rows="3" class="form-control px-3" name="txt_alamat_sekolah_asal" id="txt_alamat_sekolah_asal" placeholder="" required><?= old('txt_alamat_sekolah_asal') ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Kelas Awal</label>
                                <select name="txt_kelas_awal" class="form-control" placeholder="" required>
                                    <option value="" class="text-center">--Pilih Kelas Awal--</option>
                                    <?php foreach ($dt_kelas as $kls) : ?>
                                        <option value="<?= $kls['kelas_id'] ?>"><?= $kls['kelas_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Kelas Sekarang</label>
                                <select name="txt_kelas_sekarang" class="form-control" placeholder="" required>
                                    <option value="" class="text-center">--Pilih Kelas Sekarang--</option>
                                    <?php foreach ($dt_kelas as $kls) : ?>
                                        <option value="<?= $kls['kelas_id'] ?>"><?= $kls['kelas_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_tanggal_diterima">Tanggal Diterima</label>
                                <input type="text" class="form-control px-3 eraport-date" name="txt_tanggal_diterima" id="txt_tanggal_diterima" value="<?= old('txt_tanggal_diterima') ?>" placeholder="dd/mm/yyyy" placeholder="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="foto_guru">Foto Siswa</label>
                                <input type="file" accept="image/*" class="form-control" name="txt_foto" id="foto" onchange="bacaGambar(event)" required>
                            </div>
                            <div class="col-12" id="pre">
                                <label for="gambar_load">Preview Foto</label><br>
                                <img src="" class="d-flex mx-auto" id="gambar_load" width="250px">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary mt-4" type="submit">
                                    Lengkapi Data Orang Tua<i class="fa fa-arrow-right pl-3"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>