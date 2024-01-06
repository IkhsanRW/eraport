<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelGuru;
use App\Models\ModelGuruMapel;
use App\Models\ModelKelas;
use App\Models\ModelNilai;
use App\Models\ModelSemester;
use App\Models\ModelSiswa;
use App\Models\ModelTahunAjar;

class Penilaian extends BaseController
{
    private $M_guru_mapel;
    private $M_tahun_ajar;
    private $M_kelas;
    private $M_guru;
    private $M_siswa;
    private $M_nilai;
    private $M_semester;

    public function __construct()
    {
        $this->M_guru_mapel = new ModelGuruMapel();
        $this->M_tahun_ajar = new ModelTahunAjar();
        $this->M_kelas = new ModelKelas();
        $this->M_guru = new ModelGuru();
        $this->M_siswa = new ModelSiswa();
        $this->M_nilai = new ModelNilai();
        $this->M_semester = new ModelSemester();
        helper('form');
    }

    public function index()
    {
        $dtTA = $this->M_tahun_ajar->getTANow();
        $dtGuru = $this->M_guru->where('guru_account_id', session('log_auth')['accountID'])->first();
        $dtGM = $this->M_guru_mapel
            ->join('tb_mapel', 'gm_mapel_id = mapel_id')
            ->join('tb_kelas', 'gm_kelas_id = kelas_id')
            ->where('gm_guru_id', $dtGuru['guru_id'])
            ->where('gm_th_id', $dtTA['th_id'])
            ->findAll();
        $data = [
            'title' => 'Penilaian',
            'title_content' => 'Manajemen Penilaian',
            'dtGM' => $dtGM,
            'dtGuru' => $dtGuru
        ];
        return view('guru/penilaian/index', $data);
    }

    public function beri_nilai($id_gm)
    {
        $dtTA = $this->M_tahun_ajar->getTANow();
        $dtGuru = $this->M_guru->where('guru_account_id', session('log_auth')['accountID'])->first();
        $dtGM = $this->M_guru_mapel
            ->join('tb_mapel', 'gm_mapel_id = mapel_id')
            ->join('tb_kelas', 'gm_kelas_id = kelas_id')
            ->where('gm_th_id', $dtTA['th_id'])
            ->where('gm_guru_id', $dtGuru['guru_id'])
            ->where('gm_id', $id_gm)
            ->first();
        if (empty($dtGM)) {
            return $this->redirectBackWithAlert("Data mapel tidak ditemukan");
        }
        $dtSiswa = $this->M_siswa->where('siswa_kelas_sekarang', $dtGM['gm_kelas_id'])->findAll();
        $dtSemester = $this->M_semester->getActiveSemester();
        if (empty($dtSemester)) {
            return $this->redirectBackWithAlert('Data semester aktif belum ditemukan');
        }
        $tmpNilai = $this->M_nilai
            ->where('nilai_semester_id', $dtSemester['semester_id'])
            ->where('nilai_gm_id', $dtGM['gm_id'])
            ->findAll();
        $dtNilai = [];
        foreach ($tmpNilai as $dt) {
            $dtNilai[$dt['nilai_siswa_id']] = $dt;
        }
        $data = [
            'title' => 'Penilaian',
            'title_content' => 'Beri Penilaian',
            'dtGM' => $dtGM,
            'dtSiswa' => $dtSiswa,
            'dtNilai' => $dtNilai
        ];
        return view('guru/penilaian/beri_nilai', $data);
    }

    public function save($gm_id)
    {
        $dtTA = $this->M_tahun_ajar->getTANow();
        $dtGuru = $this->M_guru->where('guru_account_id', session('log_auth')['accountID'])->first();
        $dtGM = $this->M_guru_mapel
            ->where('gm_guru_id', $dtGuru['guru_id'])
            ->where('gm_id', $gm_id)
            ->where('gm_th_id', $dtTA['th_id'])
            ->first();
        if (empty($dtGM)) {
            return $this->redirectBackWithAlert('Data mapel tidak ditemukan');
        }
        $dtSiswa = $this->M_siswa->where('siswa_kelas_sekarang', $dtGM['gm_kelas_id'])->findAll();
        if (count($dtSiswa) == 0) {
            return $this->redirectBackWithAlert('Data siswa kosong');
        }
        $keyDataValidate = [];
        foreach ($dtSiswa as $dt) {
            $keyDataValidate["nk" . $dt['siswa_nis']] = 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]';
            $keyDataValidate["np" . $dt['siswa_nis']] = 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]';
        }
        if (!$this->validate($keyDataValidate)) {
            return $this->redirectBackWithAlert('Data nilai tidak valid');
        }
        $dtSemester = $this->M_semester->getActiveSemester();
        if (empty($dtSemester)) {
            return $this->redirectBackWithAlert('Data semester aktif belum ditemukan');
        }
        $tmpNilai = $this->M_nilai
            ->where('nilai_semester_id', $dtSemester['semester_id'])
            ->where('nilai_gm_id', $dtGM['gm_id'])
            ->findAll();
        if (count($tmpNilai) > 0) {
            return $this->redirectBackWithAlert('Data telah dimasukan sebelumnya');
        }
        foreach ($dtSiswa as $dt) {
            $data = [
                'nilai_pengetahuan' => $this->request->getPost("np" . $dt['siswa_nis']),
                'nilai_keterampilan' => $this->request->getPost("nk" . $dt['siswa_nis']),
                'nilai_siswa_id' => $dt['siswa_id'],
                'nilai_gm_id' => $dtGM['gm_id'],
                'nilai_semester_id' => $dtSemester['semester_id'],
                'nilai_updated_by' => session('log_auth')['accountID'],
                'nilai_created_by' => session('log_auth')['accountID']
            ];
            $this->M_nilai->insert($data);
        }
        return $this->redirectBackWithAlert('Data nilai berhasil dimasukan', 'success');
    }

    public function edit($gm_id)
    {
        $dtTA = $this->M_tahun_ajar->getTANow();
        $dtGuru = $this->M_guru->where('guru_account_id', session('log_auth')['accountID'])->first();
        $dtGM = $this->M_guru_mapel
            ->where('gm_guru_id', $dtGuru['guru_id'])
            ->where('gm_id', $gm_id)
            ->where('gm_th_id', $dtTA['th_id'])
            ->first();
        if (empty($dtGM)) {
            return $this->redirectBackWithAlert('Data mapel tidak ditemukan');
        }
        $dtSiswa = $this->M_siswa->where('siswa_kelas_sekarang', $dtGM['gm_kelas_id'])->findAll();
        if (count($dtSiswa) == 0) {
            return $this->redirectBackWithAlert('Data siswa kosong');
        }
        $dtIDSiswa = [];
        $keyDataValidate = [];
        foreach ($dtSiswa as $dt) {
            $keyDataValidate["nk" . $dt['siswa_nis']] = 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]';
            $keyDataValidate["np" . $dt['siswa_nis']] = 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]';
            $dtIDSiswa[$dt['siswa_id']] = $dt['siswa_nis'];
        }
        if (!$this->validate($keyDataValidate)) {
            return $this->redirectBackWithAlert('Data nilai tidak valid');
        }
        $dtSemester = $this->M_semester->getActiveSemester();
        if (empty($dtSemester)) {
            return $this->redirectBackWithAlert('Data semester aktif belum ditemukan');
        }
        $tmpNilai = $this->M_nilai
            ->where('nilai_semester_id', $dtSemester['semester_id'])
            ->where('nilai_gm_id', $dtGM['gm_id'])
            ->findAll();
        if (count($tmpNilai) == 0) {
            return $this->redirectBackWithAlert('Data belum dimasukan sebelumnya');
        }
        foreach ($tmpNilai as $dt) {
            $data = [
                'nilai_pengetahuan' => $this->request->getPost("np" . $dtIDSiswa[$dt['nilai_siswa_id']]),
                'nilai_keterampilan' => $this->request->getPost("nk" . $dtIDSiswa[$dt['nilai_siswa_id']]),
                'nilai_updated_by' => session('log_auth')['accountID']
            ];
            $this->M_nilai->update($dt['nilai_id'], $data);
        }
        return $this->redirectBackWithAlert('Data nilai berhasil dirubah', 'success');
    }
}
