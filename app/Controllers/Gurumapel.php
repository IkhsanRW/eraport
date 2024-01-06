<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelGuru;
use App\Models\ModelGuruMapel;
use App\Models\ModelKelas;
use App\Models\ModelMapel;
use App\Models\ModelTahunAjar;

class Gurumapel extends BaseController
{
    private $M_guru;
    private $M_mapel;
    private $M_kelas;
    private $M_tahun_ajar;
    private $M_guru_mapel;

    public function __construct()
    {
        $this->M_mapel = new ModelMapel();
        $this->M_guru = new ModelGuru();
        $this->M_kelas = new ModelKelas();
        $this->M_tahun_ajar = new ModelTahunAjar();
        $this->M_guru_mapel = new ModelGuruMapel();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Guru Mapel',
            'title_content' => 'Manajemen Guru Mapel',
            'dt_guru' => $this->M_guru->findAll()
        ];
        return view('admin/guru_mapel/index', $data);
    }

    public function detail($id_guru)
    {
        if (is_null($id_guru) || !is_numeric($id_guru)) {
            return $this->redirectBackWithAlert('Data guru tidak sesuai');
        }
        $dtGuru = $this->M_guru->find($id_guru);
        if (empty($dtGuru)) {
            return $this->redirectBackWithAlert('Data guru tidak ditemukan');
        }
        $dtTA = $this->M_tahun_ajar->getTANow();
        helper('mapel');
        $dtGM = $this->M_guru_mapel
            ->join('tb_mapel', 'gm_mapel_id = mapel_id')
            ->join('tb_kelas', 'gm_kelas_id = kelas_id')
            ->where('gm_guru_id', $id_guru)
            ->where('gm_th_id', $dtTA['th_id'])
            ->findAll();
        $data = [
            'title' => 'Guru Mapel',
            'title_content' => 'Manajemen Guru Mapel',
            'dt_guru' => $dtGuru,
            'dt_mapel' => $this->M_mapel->findAll(),
            'dt_kelas' => $this->M_kelas->findAll(),
            'id_guru' => $id_guru,
            'dt_gm' => $dtGM
        ];
        return view('admin/guru_mapel/detail', $data);
    }

    public function addmapel($id_guru)
    {
        // Validate
        $dtTA = $this->M_tahun_ajar->getTANow();
        if (empty($dtTA)) {
            return $this->redirectBackWithAlert('Tahun ajaran masih kosong');
        }
        if (is_null($id_guru) || !is_numeric($id_guru)) {
            return $this->redirectBackWithAlert('Data guru tidak sesuai');
        }
        $dtGuru = $this->M_guru->find($id_guru);
        if (empty($dtGuru)) {
            return $this->redirectBackWithAlert('Data guru tidak ditemukan');
        }
        if (!$this->validate([
            'txt_grade' => 'required|in_list[10,11,12]',
            'txt_jurusan' => 'required|in_list[RPL,TBSM]',
            'txt_kategori_mapel' => 'required|in_list[A,B,C1,C2]',
            'txt_mapel' => 'required|is_natural_no_zero'
        ])) {
            dd($this->request->getPost());
            dd($this->validator);
            return $this->redirectBackWithAlert('Data tidak valid');
        }
        $dtMapel = $this->M_mapel->find($this->request->getPost('txt_mapel'));
        if (empty($dtMapel)) {
            return $this->redirectBackWithAlert('Data mapel tidak ditemukan');
        }
        if ($dtMapel['mapel_kategori'] != $this->request->getPost('txt_kategori_mapel')) {
            return $this->redirectBackWithAlert('Data kategori tidak sesuai dengan mapel');
        }
        if ($this->request->getPost('txt_kategori_mapel') == "C1" || $this->request->getPost('txt_kategori_mapel') == "C2") {
            if ($dtMapel['mapel_grade_kelas'] != $this->request->getPost('txt_grade') || $dtMapel['mapel_jurusan'] != $this->request->getPost('txt_jurusan')) {
                return $this->redirectBackWithAlert('Data mapel dengan kategori C1 dan C2 harus sesuai dengan jurusan dan kelas yang ditentukan');
            }
        }
        $dtKelas = $this->M_kelas->where('kelas_grade', $this->request->getPost('txt_grade'))
            ->where('kelas_jurusan', $this->request->getPost('txt_jurusan'))
            ->first();
        if (empty($dtKelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak ditemukan');
        }
        $cekGM = $this->M_guru_mapel
            ->join('tb_guru', 'gm_guru_id = guru_id')
            ->where('gm_mapel_id', $dtMapel['mapel_id'])
            ->where('gm_kelas_id', $dtKelas['kelas_id'])
            ->where('gm_th_id', $dtTA['th_id'])
            ->first();
        if (!empty($cekGM)) {
            if ($cekGM['gm_guru_id'] == $dtGuru['guru_id']) {
                return $this->redirectBackWithAlert('Data mapel telah dimasukan sebelumnya.');
            } else {
                return $this->redirectBackWithAlert('Mapel telah diampu oleh ' . $cekGM['guru_nama']);
            }
        }
        // End validate
        $data = [
            'gm_guru_id' => $dtGuru['guru_id'],
            'gm_mapel_id' => $dtMapel['mapel_id'],
            'gm_kelas_id' => $dtKelas['kelas_id'],
            'gm_th_id' => $dtTA['th_id'],
            'gm_updated_by' => session('log_auth')['accountID'],
            'gm_created_by' => session('log_auth')['accountID']
        ];
        $this->M_guru_mapel->insert($data);
        $after = $this->M_guru_mapel->where('gm_guru_id', $dtGuru['guru_id'])
            ->where('gm_mapel_id', $dtMapel['mapel_id'])
            ->where('gm_kelas_id', $dtKelas['kelas_id'])
            ->where('gm_th_id', $dtTA['th_id'])
            ->first();
        if (!empty($after)) {
            return $this->redirectBackWithAlert('Data mapel berhasil dimasukan', 'success');
        }
        return $this->redirectBackWithAlert('Data mapel gagak dimasukan karena kesalahan sistem');
    }
}
