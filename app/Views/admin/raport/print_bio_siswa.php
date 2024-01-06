<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Raport | <?= $title ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/img/bg_login.jpg') ?>" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('') ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

    <style>
        @page {
            size: a4;
            margin: 3cm;
        }
    </style>
</head>

<body class="font-arial">

    <div class="container-fluid text-black">

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="text-uppercase font-14 fw-bold text-center">keterangan tentang data diri peserta didik</div>
            </div>
            <div class="col-12 mt-5">
                <table class="w-100 text-capitalize font-12">
                    <tr>
                        <td class="cell-fit">1.</td>
                        <td width="300px">nama peserta didik (lengkap)</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_nama'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">2.</td>
                        <td width="300px">nomer induk siswa</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_nis'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">3.</td>
                        <td width="300px">nomer induk siswa nasional (NISN)</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_nisn'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">4.</td>
                        <td width="300px">tempat / tanggal lahir</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_tempat_lahir'] . ", " . $dtSiswa['siswa_tanggal_lahir'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">5.</td>
                        <td width="300px">jenis kelamin</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_nis'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">6.</td>
                        <td width="300px">agama</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_jenis_kelamin'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">7.</td>
                        <td width="300px">status dalam keluaraga</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_status_dalam_keluarga'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">8.</td>
                        <td width="300px">anak ke-</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_anak_ke'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">9.</td>
                        <td width="300px">alamat peserta didik</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_alamat'] ?> </td>
                    </tr>
                    <tr>
                        <td class="cell-fit">10.</td>
                        <td width="300px">nomor telepon rumah</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_telepon'] ?> </td>
                    </tr>
                    <!-- nomer 11 -->
                    <tr>
                        <td class="cell-fit">11.</td>
                        <td width="300px">Sekolah Asal</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">Nama Sekolah Asal</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_sekolah_asal'] ?> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">Alamat Sekolah Asal</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_alamat_sekolah_asal'] ?> </td>
                    </tr>
                    <!-- end nomer 11 -->
                    <!-- nomer 12 -->
                    <tr>
                        <td class="cell-fit">12.</td>
                        <td width="300px">diterima di sekolah ini</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">Di kelas</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['kelas_nama'] ?> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">Pada tanggal</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['siswa_tanggal_diterima'] ?> </td>
                    </tr>
                    <!-- end nomer 12 -->
                    <!-- nomer 13 -->
                    <tr>
                        <td class="cell-fit">13.</td>
                        <td width="300px">nama orang tua</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">nama ayah</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['ortu_ayah'] ?> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">nama ibu</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['ortu_ibu'] ?> </td>
                    </tr>
                    <!-- end nomer 13 -->
                    <!-- nomer 14 -->
                    <tr>
                        <td class="cell-fit">14.</td>
                        <td width="300px">Alamat orang tua</td>
                        <td class="px-1">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">no. telepon rumah/hP</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['ortu_alamat'] ?> </td>
                    </tr>
                    <!-- end nomer 14 -->
                    <!-- nomer 15 -->
                    <tr>
                        <td class="cell-fit">15.</td>
                        <td width="300px">pekerjaan orang tua</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">pekerjaan ayah</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['ortu_pekerjaan_ayah'] ?> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">pekerjaan ibu</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['ortu_pekerjaan_ibu'] ?> </td>
                    </tr>
                    <!-- end nomer 15 -->
                    <tr>
                        <td class="cell-fit">16.</td>
                        <td width="300px">nama wali peserta didik</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['wali_nama'] ?> </td>
                    </tr>
                    <!-- nomer 17 -->
                    <tr>
                        <td class="cell-fit">17.</td>
                        <td width="300px">Alamat wali</td>
                        <td class="px-1">:</td>
                        <td><?= $dtSiswa['wali_alamat'] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="ps-3" width="300px">no. telepon rumah/hP</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['wali_telepon'] ?> </td>
                    </tr>
                    <!-- end nomer 17 -->
                    <tr>
                        <td class="cell-fit">18.</td>
                        <td width="300px">pekerjaan wali peserta didik</td>
                        <td class="px-1">:</td>
                        <td> <?= $dtSiswa['wali_pekerjaan'] ?> </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 mt-5">
                <div class="row font-12">
                    <div class="col-4 d-flex justify-content-center">
                        <div class="border" style="width: 3cm; height: 4cm;">*foto 3x4</div>
                    </div>
                    <div class="col-8">
                        <table>
                            <tr>
                                <td>Sleman, 1 Januari 2024</td>
                            </tr>
                            <tr>
                                <td>Kepala Sekolah</td>
                            </tr>
                            <tr>
                                <td class="py-5"></td>
                            </tr>
                            <tr>
                                <td class="text-uppercase">roni elistanto, M.Pd</td>
                            </tr>
                            <tr>
                                <td>NBM. 1053889</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        window.print();
    </script>


</body>

</html>