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
                    <div class="row">
                        <div class="col-2">
                            <img src="<?= base_url('assets/img/' . $dt_guru['guru_foto']) ?>" class="card-img-top rounded">
                        </div>
                        <div class="col">
                            <div class="card-title fs-4 fw-bold"><?= $dt_guru['guru_nama'] ?></div>
                            <div class="row mb-3 w-25">
                                <div class="col-6">
                                    <div class="card-text text-muted">NIP GURU :</div>
                                </div>
                                <div class="col-6">
                                    <div class="card-text"><?= $dt_guru['guru_nip'] ?></div>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-flat btn-primary" data-bs-toggle="modal" data-bs-target="#add_mapel">
                                Tambah Mapel&ensp;<i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="cell-fit">No</th>
                                <th>Nama Mapel</th>
                                <th>Kategori</th>
                                <th>Kelas Diajar</th>
                                <th>Jurusan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_gm as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['mapel_nama'] ?></td>
                                    <td><?= $value['mapel_kategori'] ?> (<?= getCategoryMapel()[$value['mapel_kategori']] ?>)</td>
                                    <td><?= $value['kelas_grade'] ?></td>
                                    <td><?= $value['kelas_jurusan'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Mapel -->
    <form action="<?= base_url('gurumapel/addmapel/' . $id_guru) ?>" method="post">
        <div class="modal fade" id="add_mapel" tabindex="-1" aria-labelledby="add_mapelLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <div class="modal-title fs-5">Tambah Mapel Diajar</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="txt_grade">Kelas</label>
                            <select id="txt_grade" name="txt_grade" class="form-select" aria-label="Default select example" onchange="setOptionMapel()">
                                <option selected>-- Pilih Kelas --</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txt_jurusan">Jurusan</label>
                            <select id="txt_jurusan" name="txt_jurusan" class="form-select" aria-label="Default select example" onchange="setOptionMapel()">
                                <option selected>-- Pilih Jurusan --</option>
                                <option value="RPL">RPL</option>
                                <option value="TBSM">TBSM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txt_kategori_mapel">Kategori</label>
                            <select id="txt_kategori_mapel" name="txt_kategori_mapel" class="form-select" aria-label="Default select example" onchange="setOptionMapel()">
                                <option selected>-- Pilih Kategori --</option>
                                <?php foreach (getCategoryMapel() as $key => $val) : ?>
                                    <option value="<?= $key ?>"><?= $key ?> (<?= $val ?>)</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txt_mapel">Mata Pelajaran</label>
                            <select id="txt_mapel" name="txt_mapel" class="form-select" aria-label="Default select example">
                                <option selected>-- Pilih Mata Pelajaran --</option>
                                <?php foreach ($dt_mapel as $key => $value) { ?>
                                    <option value="<?= $value['mapel_nama'] ?>"><?= $value['mapel_nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Mapel -->

</div>
<script>
    const dtMapel = <?= json_encode($dt_mapel) ?>;

    function setOptionMapel() {
        $("#txt_mapel").empty();
        $("#txt_mapel").append($('<option selected>-- Pilih Mata Pelajaran --</option>'));
        if ($('#txt_kategori_mapel').val() != "" && $('#txt_jurusan').val() != "" && $('#txt_grade').val() != "") {
            dtMapel.forEach(element => {
                if ($('#txt_kategori_mapel').val() == "C1" || $('#txt_kategori_mapel').val() == "C2") {
                    if ($('#txt_kategori_mapel').val() == element.mapel_kategori && $('#txt_jurusan').val() == element.mapel_jurusan && $('#txt_grade').val() == element.mapel_grade_kelas) {
                        $("#txt_mapel").append($('<option></option>').text(element.mapel_nama).attr('value', element.mapel_id));
                    }
                    console.log("aaaa");
                } else {
                    if ($('#txt_kategori_mapel').val() == element.mapel_kategori) {
                        $("#txt_mapel").append($('<option></option>').text(element.mapel_nama).attr('value', element.mapel_id));
                    }
                    console.log('bbbb');
                }
            });
        }
    }
</script>
<?= $this->endsection(); ?>