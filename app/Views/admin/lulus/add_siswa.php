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
                    <div class="card-title fs-4 fw-bold"><?= $dt_kelas['kelas_nama'] ?></div>
                    <div class="row mb-3 w-25">
                        <div class="col-6">
                            <div class="card-text text-muted">Tahun Ajaran</div>
                        </div>
                        <div class="col-5">
                            <div class="card-text"><?= $th_ajaran['th_nama'] ?></div>
                        </div>
                    </div>
                    <?php if (session('log_status_kelulusan')) : ?>
                        <button class="btn btn-sm btn-flat btn-secondary" data-bs-toggle="modal" data-bs-target="#log">
                            Show Log
                        </button>
                    <?php endif ?>
                </div>
                <div class="card-body">
                    <form id="formKelulusan" action="<?= base_url('lulus/proses/' . $id_kelas) ?>" method="post">
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
                                            Siswa yang Lulus hanyalah siswa yang telah dipilih & data siswa yang telah Lulus <b>tidak bisa</b> dikembalikan.&emsp;Apakah Anda sudah yakin?
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" onclick="$('#formKelulusan').submit()">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="log" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Log Status Kenaikan Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="cell-fit">No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            if (session('log_status_kelulusan')) :
                                foreach (session('log_status_kelulusan')['fail'] as $key => $value) : ?>
                                    <tr class="bg-danger-subtle">
                                        <td class="bg-danger-subtle"><?= $no++ ?></td>
                                        <td class="bg-danger-subtle"><?= $value['NIS'] ?></td>
                                        <td class="bg-danger-subtle"><?= $value['Nama'] ?></td>
                                        <td class="bg-danger-subtle">Gagal</td>
                                        <td class="bg-danger-subtle"><?= $value['Keterangan'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <?php foreach (session('log_status_kelulusan')['success'] as $key => $value) : ?>
                                    <tr class="bg-success-subtle">
                                        <td class="bg-success-subtle"><?= $no++ ?></td>
                                        <td class="bg-success-subtle"><?= $value['NIS'] ?></td>
                                        <td class="bg-success-subtle"><?= $value['Nama'] ?></td>
                                        <td class="bg-success-subtle">Sukses</td>
                                        <td class="bg-success-subtle"><?= $value['Keterangan'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>