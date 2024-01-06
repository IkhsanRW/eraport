<?= $this->extend('template/index') ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-dark" onclick="window.open('<?= base_url('raport/print_raport/' . $dt_kelas['kelas_id'] . '/' . $dt_ta['th_id'] . '/1' . '/' . $dt_siswa['siswa_nis']) ?>')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Print Raport">
                            <i class="fa fa-print"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="text-black">

                        <!-- Lembar 1 -->
                        <div class="pindah-line">
                            <div class="row">
                                <!-- Header -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-7">
                                            <table class="w-100">
                                                <tr>
                                                    <td>Nama Sekolah</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold">smk muhammadiyah seyegan</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Peserta Didik</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_siswa['siswa_nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kelas</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_kelas['kelas_nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tahun Pelajaran</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_ta['th_nama'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-5">
                                            <table>
                                                <tr>
                                                    <td>Semester</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase">ganjil</td>
                                                </tr>
                                                <tr>
                                                    <td>NIS</td>
                                                    <td class="px-3">:</td>
                                                    <td><?= $dt_siswa['siswa_nis'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>NISN</td>
                                                    <td class="px-3">:</td>
                                                    <td><?= $dt_siswa['siswa_nisn'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4 text-uppercase fw-bold">capaian hasil belajar</div>
                                <!-- Bagian A -->
                                <div class="col-12">
                                    <div class="py-2 text-capitalize fw-bold">a. nilai akademik</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <thead class="text-capitalize text-center">
                                            <th class="cell-fit">no</th>
                                            <th>mata pelajaran</th>
                                            <th>pengetahuan</th>
                                            <th>keterampilan</th>
                                            <th>nilai akhir</th>
                                            <th>predikat</th>
                                        </thead>
                                        <!-- Bagian a -->
                                        <thead>
                                            <th colspan="6">A. Muatan Nasional</th>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                            <?php $no = 1; ?>
                                            <?php foreach ($listMapel as $dt) : ?>
                                                <?php if ($dt['mapel_kategori'] == "A") : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $dt['mapel_nama'] ?></td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['np'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['nk'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </tbody>
                                        <!-- end bagian a -->
                                        <!-- Bagian b -->
                                        <thead>
                                            <th colspan="6">B. Muatan Kewilayahan</th>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                            <?php $no = 1; ?>
                                            <?php foreach ($listMapel as $dt) : ?>
                                                <?php if ($dt['mapel_kategori'] == "B") : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $dt['mapel_nama'] ?></td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['np'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['nk'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </tbody>
                                        <!-- end bagian b -->

                                        <!-- Bagian c -->
                                        <thead>
                                            <th colspan="6">C. Muatan Peminatan Kejuruan</th>
                                        </thead>
                                        <!-- Bagian C1 -->
                                        <thead>
                                            <th colspan="6">C1. Dasar Bidang Keahlian</th>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                            <?php $no = 1; ?>
                                            <?php foreach ($listMapel as $dt) : ?>
                                                <?php if ($dt['mapel_kategori'] == "C1") : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $dt['mapel_nama'] ?></td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['np'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['nk'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </tbody>
                                        <!-- end bagian C1 -->
                                        <!-- Bagian C2 -->
                                        <thead>
                                            <th colspan="6">C2. Dasar Program Keahlian</th>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                            <?php $no = 1; ?>
                                            <?php foreach ($listMapel as $dt) : ?>
                                                <?php if ($dt['mapel_kategori'] == "C2") : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $dt['mapel_nama'] ?></td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['np'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            try {
                                                                echo $dt_nilai[$dt['mapel_id']]['nk'];
                                                            } catch (\Throwable $th) {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </tbody>
                                        <!-- end bagian C2 -->
                                        <!-- end bagian c -->

                                        <tbody class="text-center">
                                            <tr>
                                                <td colspan="3">JUMLAH</td>
                                                <td colspan="3"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">RATA-RATA</td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Bagian B -->
                                <div class="col-12">
                                    <div class="py-2 text-capitalize fw-bold">b. catatan akademik</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <tr>
                                            <td colspan="6">&ensp;</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Lembar 2  -->
                        <div class="pindah-line">
                            <div class="row">
                                <!-- Header -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-7">
                                            <table class="w-100">
                                                <tr>
                                                    <td>Nama Peserta Didik</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_siswa['siswa_nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kelas</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_kelas['kelas_nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>NIS</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_siswa['siswa_nis'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>NISN</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_siswa['siswa_nisn'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bagian C -->
                                <div class="col-12">
                                    <div class="pt-4 pb-2 text-capitalize fw-bold">c. praktik kerja lapangan</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <thead class="text-capitalize text-center">
                                            <th class="cell-fit">no</th>
                                            <th>mitra DU/DI</th>
                                            <th>lokasi PKL</th>
                                            <th>lama (bulan)</th>
                                            <th>keterangan</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Bagian D -->
                                <div class="col-12">
                                    <div class="py-2 text-capitalize fw-bold">d. ekstrakurikuler</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <thead class="text-capitalize text-center">
                                            <th class="cell-fit">no</th>
                                            <th>Kegiatan Ekstrakurikuler</th>
                                            <th>keterangan</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Bagian E -->
                                <div class="col-12">
                                    <div class="py-2 text-capitalize fw-bold">e. ketidakhadiran</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Sakit</td>
                                                <td>5 hari</td>
                                            </tr>
                                            <tr>
                                                <td>Ijin</td>
                                                <td> hari</td>
                                            </tr>
                                            <tr>
                                                <td>Tanpa Keterangan</td>
                                                <td>hari</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Bagian E -->
                                <div class="col-12">
                                    <div class="py-2 text-capitalize fw-bold">e. catatan wali kelas / kenaikan kelas</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <tr>
                                            <td colspan="6">&ensp;</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-12 mt-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="w-100">Mengetahui, </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <table>
                                                <tr>
                                                    <td>Orang tua / Wali</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-5"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase"> .......................................... </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table>
                                                <tr>
                                                    <td>Wali Kelas</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-5"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase"> .......................................... </td>
                                                </tr>
                                                <tr>
                                                    <td>NBM. </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lembar 3 -->
                        <div class="pindah-line">
                            <div class="row">
                                <!-- Header -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-7">
                                            <table class="w-100">
                                                <tr>
                                                    <td>Nama Peserta Didik</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_siswa['siswa_nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kelas</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_kelas['kelas_nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>NIS</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_siswa['siswa_nis'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>NISN</td>
                                                    <td class="px-3">:</td>
                                                    <td class="text-uppercase fw-bold"><?= $dt_siswa['siswa_nisn'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bagian F -->
                                <div class="col-12">
                                    <div class="pt-5 pb-2 text-capitalize fw-bold">f. deskripsi perkembangan karakter</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <thead class="text-capitalize text-center">
                                            <th class="cell-fit">karakter yang dibangun</th>
                                            <th>deskripsi</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Integritas</td>
                                                <td>Siswa sudah menunjukkan sikap empati terhadap sesama</td>
                                            </tr>
                                            <tr>
                                                <td>Religius</td>
                                                <td>Siswa sudah menunjukkan sikap taat beribadah dan perlu bimbingan dalam sikap santun dalam tindakan</td>
                                            </tr>
                                            <tr>
                                                <td>Nasionalis</td>
                                                <td>Siswa sudah menunjukkan sikap tekun belajar dan perlu bimbingan dalarn sikap aktif di kegiatan kesiswaan</td>
                                            </tr>
                                            <tr>
                                                <td>Mandiri</td>
                                                <td>Siswa sudah menunjukkan sikap berwawasan IT dan perlu bimbingan dalam sikap berpikir kritis</td>
                                            </tr>
                                            <tr>
                                                <td>Gotong-royong</td>
                                                <td>Siswa sudah menunjukkan sikap bekerja sama dan perlu bimbingan dalam sikap aktif dalam kegiatan sosial</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Bagian H -->
                                <div class="col-12">
                                    <div class="py-2 text-capitalize fw-bold">H. catatan perkembangan karakter</div>
                                    <table class="w-100 table table-sm table-bordered">
                                        <tr>
                                            <td colspan="6">&ensp;</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-12 mt-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="w-100">Mengetahui, </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <table>
                                                <tr>
                                                    <td>Orang tua / Wali</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-5"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase"> .......................................... </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table>
                                                <tr>
                                                    <td>Wali Kelas</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-5"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase"> .......................................... </td>
                                                </tr>
                                                <tr>
                                                    <td>NBM. </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>