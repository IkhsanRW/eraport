<?php

namespace App\Controllers;

use App\Models\ModelGuru;
use App\Models\ModelMapel;
use App\Models\ModelTahunAjar;

class Mapel extends BaseController
{
    private $M_mapel = null;
    private $M_guru = null;
    private $M_tahun_ajar = null;

    public function __construct()
    {
        $this->M_mapel = new ModelMapel();
        $this->M_guru = new ModelGuru();
        $this->M_tahun_ajar = new ModelTahunAjar();
        helper('form');
    }
    public function index(): string
    {
        helper('mapel');
        $data = [
            'title' => 'Mata Pelajaran',
            'title_content' => 'Manajemen Mata Pelajaran',
            'dt_mapel' => $this->M_mapel->findAll()
        ];
        return view('admin/mapel/index', $data);
    }
    public function insertData()
    {
        if (!$this->validate([
            'txt_kategori' => 'required|in_list[A,B,C1,C2]',
            'txt_nama' => 'required'
        ])) {
            return $this->redirectBackWithAlert('Data tidak valid');
        }
        $data_mapel = [
            'mapel_nama' => $this->request->getPost('txt_nama'),
            'mapel_kategori' => $this->request->getPost('txt_kategori'),
        ];
        if ($this->request->getPost('txt_kategori') == 'C1' || $this->request->getPost('txt_kategori') == 'C2') {
            if (!$this->validate([
                'txt_kelas' => 'required|in_list[10,11,12]',
                'txt_jurusan' => 'required|in_list[TBSM,RPL]'
            ])) {
                return $this->redirectBackWithAlert('Data tidak valid');
            }
            $data_mapel['mapel_jurusan'] = $this->request->getPost('txt_jurusan');
            $data_mapel['mapel_grade_kelas'] = $this->request->getPost('txt_kelas');
        }
        $this->M_mapel->insert($data_mapel);
        return redirect()->to('mapel')->with('success', 'Data berhasil ditambah');
    }
    public function editData($mapel_id)
    {
        $data_mapel = [
            'mapel_nama' => $this->request->getPost('txt_nama'),
            'mapel_grade_kelas' => $this->request->getPost('txt_kelas'),
            'mapel_jurusan' => $this->request->getPost('txt_jurusan'),
            'mapel_kategori' => $this->request->getPost('txt_kategori'),
        ];
        $this->M_mapel->update($mapel_id, $data_mapel);

        return redirect()->to('mapel')->with('success', 'Data berhasil Diubah');
    }
    public function deleteData($mapel_id)
    {
        $this->M_mapel->delete($mapel_id);
        return redirect()->to(base_url('mapel'))->with('danger', 'Data berhasil dihapus');
    }
}
