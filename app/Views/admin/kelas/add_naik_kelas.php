<?= $this->extend('template/index') ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title_content ?></h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form id="formNaikKelas" action="<?= base_url('naikkelas/proses/' . $id_kelas) ?>" method="post">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead class="text-uppercase">
                                <tr>
                                    <th class="cell-fit">*</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dt_siswa as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <input class="btn-check" type="checkbox" name="pilih_siswa[]" id="pilih_siswa<?= $value['siswa_nis'] ?>" value="<?= $value['siswa_nis'] ?>" required>
                                            <label class="btn btn-outline-danger" for="pilih_siswa<?= $value['siswa_nis'] ?>">
                                                Pilih
                                            </label>
                                        </td>
                                        <td><?= $value['siswa_nis'] ?></td>
                                        <td><?= $value['siswa_nama'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>

                    <div class="row mt-4">
                        <div class="col-6 mx-auto d-flex">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#confirm">Submit</button>
                        </div>
                    </div>

                    <div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-2">
                                    <div class="alert alert-warning" role="alert">
                                        <div><i class="fas fa-exclamation-triangle"></i>&ensp;<b>Perhatian</b></div>
                                        <div class="text-justify pt-1 fs-6">
                                            Siswa yang naik kelas hanyalah siswa yang telah dipilih.&emsp;Apakah Anda sudah yakin?
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="btnNaikKelas" type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#btnNaikKelas').click(function() {
        $("#formNaikKelas").submit();
    });
</script>
<?= $this->endSection(); ?>