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
                    <?= form_open_multipart('siswa/editdatasiswa/' . $dt_siswa['siswa_id']) ?>
                    <div class="row">
                        <div class="col px-5 py-4 border-right">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="txt_nama">Nama Lengkap</label>
                                    <input type="text" class="form-control px-3" name="txt_nama" id="txt_nama" old="<?= old('txt_nama') ?>" value="<?= $dt_siswa['siswa_nama'] ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_nis">Nomor Induk Siswa (NIS)</label>
                                    <input type="number" min="0" class="form-control px-3" name="txt_nis" id="txt_nis" old="<?= old('txt_nis') ?>" value="<?= $dt_siswa['siswa_nis'] ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_nisn">Nomor Induk Siswa Nasional (NISN)</label>
                                    <input type="number" min="0" class="form-control px-3" name="txt_nisn" id="txt_nisn" old="<?= old('txt_nisn') ?>" value="<?= $dt_siswa['siswa_nisn'] ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_tempat_lahir">Tempat Lahir</label>
                                    <!-- Tempat lahir pakai select? input manual? -->
                                    <input type="text" class="form-control px-3" name="txt_tempat_lahir" id="txt_tempat_lahir" old="<?= old('txt_tempat_lahir') ?>" value="<?= $dt_siswa['siswa_tempat_lahir'] ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control px-3 eraport-date" name="txt_tanggal_lahir" id="txt_tanggal_lahir" old="<?= old('txt_tanggal_lahir') ?>" value="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Jenis Kelamin</label>
                                    <div class="row">
                                        <div class="col pe-2">
                                            <input class="btn-check" type="radio" name="txt_jenis_kelamin" value="Laki-Laki" <?= ($dt_siswa['siswa_jenis_kelamin'] == 'Laki-Laki') ? 'checked' : '' ?> id="txt_laki">
                                            <label class="btn btn-outline-danger w-100" for="txt_laki">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="col ps-2">
                                            <input class="btn-check" type="radio" name="txt_jenis_kelamin" value="Perempuan" <?= ($dt_siswa['siswa_jenis_kelamin'] == 'Perempuan') ? 'checked' : '' ?> id="txt_perempuan">
                                            <label class="btn btn-outline-danger w-100" for="txt_perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_agama">Agama</label>
                                    <select name="txt_agama" class="form-control">
                                        <?php foreach ($agama as $dt) : ?>
                                            <option value="<?= $dt ?>" <?= ($dt == $dt_siswa['siswa_agama']) ? 'selected' : '' ?>><?= $dt ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_status_keluarga">Status Dalam Keluarga</label>
                                    <input type="text" class="form-control px-3" name="txt_status_keluarga" id="txt_status_keluarga" old="<?= old('txt_status_keluarga') ?>" value="<?= $dt_siswa['siswa_status_dalam_keluarga'] ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_anak_ke">Anak ke-</label>
                                    <input type="number" min="1" class="form-control px-3" name="txt_anak_ke" id="txt_anak_ke" old="<?= old('txt_anak_ke') ?>" value="<?= $dt_siswa['siswa_anak_ke'] ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="txt_alamat">Alamat Siswa</label>
                                    <textarea rows="3" class="form-control px-3" name="txt_alamat" id="txt_alamat" old="<?= old('txt_alamat') ?>" required><?= $dt_siswa['siswa_alamat'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col px-5 py-4 border-left">
                            <div class="col-12 mb-3">
                                <label for="txt_telepon">Telepon</label>
                                <input type="text" inputmode="tel" class="form-control px-3" name="txt_telepon" id="txt_telepon" old="<?= old('txt_telepon') ?>" value="<?= $dt_siswa['siswa_telepon'] ?>" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_sekolah_asal">Nama Sekolah Asal</label>
                                <input type="text" class="form-control px-3" name="txt_sekolah_asal" id="txt_sekolah_asal" old="<?= old('txt_sekolah_asal') ?>" value="<?= $dt_siswa['siswa_sekolah_asal'] ?>" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_alamat_sekolah_asal">Alamat Sekolah Asal</label>
                                <textarea rows="3" class="form-control px-3" name="txt_alamat_sekolah_asal" id="txt_alamat_sekolah_asal" old="<?= old('txt_alamat_sekolah_asal') ?>" required><?= $dt_siswa['siswa_alamat_sekolah_asal'] ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Kelas Awal</label>
                                <select name="txt_kelas_awal" class="form-control" required>
                                    <?php foreach ($dt_kelas as $kls) : ?>
                                        <option class="text-center" value="<?= $kls['kelas_id'] ?>" <?= ($kls['kelas_id'] == $dt_siswa['siswa_kelas_awal']) ? 'selected' : '' ?>><?= $kls['kelas_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Kelas Sekarang</label>
                                <select name="txt_kelas_sekarang" class="form-control" required>
                                    <?php foreach ($dt_kelas as $kls) : ?>
                                        <option class="text-center" value="<?= $kls['kelas_id'] ?>" <?= ($kls['kelas_id'] == $dt_siswa['siswa_kelas_sekarang']) ? 'selected' : '' ?>><?= $kls['kelas_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_tanggal_diterima">Tanggal Diterima</label>
                                <input type="text" class="form-control px-3 eraport-date" name="txt_tanggal_diterima" id="txt_tanggal_diterima" old="<?= old('txt_tanggal_diterima') ?>" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="foto_guru">Foto Siswa</label>
                                <input type="file" accept="image/*" class="form-control" name="txt_foto" id="foto" onchange="bacaGambar(event)" required>
                            </div>
                            <div class="col-12" id="pre">
                                <label for="gambar_load">Preview Foto</label><br>
                                <img src="<?= base_url('foto_siswa/' . $dt_siswa['siswa_foto']) ?>" class="d-flex mx-auto" id="gambar_load" width="250px">
                            </div>
                            <div class="col-12 d-flex justify-content-center pt-1">
                                <button class="btn btn-primary mr-3" type="submit">
                                    Ubah Data Siswa
                                </button>
                                <button class="btn btn-warning" onclick="window.location.href='<?= base_url('siswa/detailortu/' . $dt_siswa['siswa_nis']) ?>'">
                                    Lengkapi Data Orang Tua <i class="fa fa-arrow-right pl-3"></i>
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
<script>
    const isEditPage = true;

    function setDateValueformDB() {
        $("#txt_tanggal_lahir").val('<?= normalizeDateFromDB($dt_siswa['siswa_tanggal_lahir'], "Y-m-d") ?>');
        $("#txt_tanggal_diterima").val('<?= normalizeDateFromDB($dt_siswa['siswa_tanggal_diterima']) ?>');
    }
</script>
<?= $this->endSection() ?>