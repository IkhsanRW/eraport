<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800"><?= $title_content ?></div>
    </div>
    <form id="formNilai" action="<?= base_url('penilaian/save/' . $dtGM['gm_id']) ?>" method="post">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fs-4 fw-bold">
                                    Data Kelas <?= $dtGM['kelas_nama'] ?>
                                </div>
                                <div class="fs-6">
                                    Mata Pelajaran&ensp;<b><?= $dtGM['mapel_nama'] ?></b>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-end">
                                <?php if (count($dtNilai) > 0) : ?>
                                    <button type="button" id="btnEdit" class="btn btn-warning">Edit</button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead class="text-uppercase">
                                        <tr>
                                            <th class="cell-fit">No</th>
                                            <th>Nis</th>
                                            <th>Nama Siswa</th>
                                            <th class="cell-fit">Nilai Katerampilan</th>
                                            <th class="cell-fit">Nilai Pengetahuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $no = 1; ?>
                                            <?php foreach ($dtSiswa as $dt) : ?>
                                                <td><?= $no++ ?></td>
                                                <td><?= $dt['siswa_nis'] ?></td>
                                                <td><?= $dt['siswa_nama'] ?></td>
                                                <td>
                                                    <?php try { ?>
                                                        <input class="form-control" type="number" min="0" max="100" name="nk<?= $dt['siswa_nis'] ?>" id="nk<?= $dt['siswa_nis'] ?>" value="<?= $dtNilai[$dt['siswa_id']]['nilai_keterampilan'] ?>">
                                                    <?php } catch (\Throwable $th) { ?>
                                                        <input class="form-control" type="number" min="0" max="100" name="nk<?= $dt['siswa_nis'] ?>" id="nk<?= $dt['siswa_nis'] ?>">
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php try { ?>
                                                        <input class="form-control" type="number" min="0" max="100" name="np<?= $dt['siswa_nis'] ?>" id="np<?= $dt['siswa_nis'] ?>" value="<?= $dtNilai[$dt['siswa_id']]['nilai_pengetahuan'] ?>">
                                                    <?php } catch (\Throwable $th) { ?>
                                                        <input class="form-control" type="number" min="0" max="100" name="np<?= $dt['siswa_nis'] ?>" id="np<?= $dt['siswa_nis'] ?>">
                                                    <?php } ?>
                                                </td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex mt-3">
                                <button id="btnSubmit" class="btn btn-sm btn-flat btn-primary mx-auto w-50 <?= (count($dtNilai) > 0) ? 'd-none' : '' ?>" type="submit">
                                    Submit Nilai Siswa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal Penilaian -->
    <div class="modal fade" id="keterampilan" tabindex="-1" aria-labelledby="add_mapelLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <div class="modal-title fs-5">Input Nilai</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Penilaian -->
</div>
<?php if (count($dtNilai) > 0) : ?>
    <script>
        $(".form-control").attr("disabled", "");
        $("#btnEdit").click(function() {
            $(".form-control").removeAttr("disabled");
            $("#formNilai").attr('action', '<?= base_url('penilaian/edit/' . $dtGM['gm_id']) ?>');
            $("#btnSubmit").removeClass("d-none");
            $(this).addClass('d-none');
        })
    </script>
<?php endif ?>

<?= $this->endSection() ?>