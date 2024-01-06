<?php

namespace App\Controllers;

use App\Models\ModelAccount;
use App\Models\ModelGuru;
use App\Models\ModelKelas;
use App\Models\ModelSiswa;
use App\Models\ModelTahunAjar;
use App\Models\ModelWaliKelas;

class Kelas extends BaseController
{
    private $M_kelas;
    private $M_siswa;
    private $M_guru;
    private $M_tahun_ajar;
    private $M_wali_kelas;
    private $M_account;

    public function __construct()
    {
        $this->M_kelas = new ModelKelas();
        $this->M_siswa = new ModelSiswa();
        $this->M_guru = new ModelGuru();
        $this->M_tahun_ajar = new ModelTahunAjar();
        $this->M_wali_kelas = new ModelWaliKelas();
        $this->M_account = new ModelAccount();
        helper('form');
    }
    public function index(): string
    {
        $data = [
            'dt_kelas' => $this->M_kelas->findAll(),
            'title' => 'Kelas',
            'title_content' => 'Manajemen Kelas'
        ];
        return view('admin/kelas/index', $data);
    }
    public function detailKelas($id_kelas)
    {
        $data = [
            'title' => 'Kelas',
            'title_content' => 'Manajemen Data Siswa',
            'dt_kelas' => $this->M_kelas->find($id_kelas),
            'dt_siswa' => $this->M_siswa->where('siswa_kelas_sekarang', $id_kelas)->findAll()
        ];
        return view('admin/kelas/detail_kelas', $data);
    }
    public function waliKelas()
    {
        $dtTA = $this->M_tahun_ajar->getTANow();
        if (empty($dtTA)) {
            return redirect()->to(base_url('tahun_ajar'))->with('danger', 'Tahun ajaran masih kosong');
        }
        $dtKelas = $this->M_kelas->findAll();
        $dtWaliKelas = [];
        foreach ($dtKelas as $dt) {
            $tmp = $this->M_wali_kelas->join('tb_guru', 'wk_guru_id = guru_id')
                ->where('wk_th_id', $dtTA['th_id'])
                ->where('wk_kelas_id', $dt['kelas_id'])
                ->first();
            $dtWaliKelas[$dt['kelas_id']] = $tmp;
        }
        $data = [
            'title' => 'Wali Kelas',
            'title_content' => 'Manajemen Wali Kelas',
            'dt_kelas' => $dtKelas,
            'dt_wali_kelas' => $dtWaliKelas,
            'dt_guru' => $this->M_guru->findAll()
        ];
        return view('admin/wali_kelas/index', $data);
    }

    public function ubahwali()
    {
        // Validate
        if (!$this->validate([
            'selectedkelas' => 'required|is_natural_no_zero|less_than_equal_to[6]',
            'pilih_wali' => 'required|is_natural_no_zero'
        ])) {
            dd($this->validator);
            return $this->redirectBackWithAlert('Data tidak valid');
        }
        $dtKelas = $this->M_kelas->find($this->request->getPost('selectedkelas'));
        if (empty($dtKelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak ditemukan');
        }
        $dtGuru = $this->M_guru->find($this->request->getPost('pilih_wali'));
        if (empty($dtGuru)) {
            return $this->redirectBackWithAlert('Data guru tidak ditemukan');
        }
        $dtTA = $this->M_tahun_ajar->getTANow();
        if (empty($dtTA)) {
            return $this->redirectBackWithAlert('Data tahun ajaran masih kosong');
        }
        // End validate
        $isWali = $this->M_wali_kelas->where('wk_guru_id', $dtGuru['guru_id'])
            ->where('wk_th_id', $dtTA['th_id'])
            ->first();
        if (!empty($isWali)) {
            // Cek apakah guru telah terdaftar di kelas ini
            if ($isWali['wk_kelas_id'] == $dtKelas['kelas_id']) {
                return $this->redirectBackWithAlert($dtGuru['guru_nama'] . ' telah menjadi wali kelas ' . $dtKelas['kelas_nama'], 'warning');
            } else {
                // Hapus wali di kelas lain
                $this->M_wali_kelas->delete($isWali['wk_id']);
            }
        }
        // Cek apakah kelas ini telah memiliki wali kelas
        $dtWali = $this->M_wali_kelas->where('wk_kelas_id', $dtKelas['kelas_id'])
            ->where('wk_th_id', $dtTA['th_id'])
            ->first();
        if (empty($dtWali)) {
            $lastDataWaliKelas = $this->M_wali_kelas->orderBy('wk_id', 'desc')->first();
            if (empty($lastDataWaliKelas)) {
                $newID = '1';
            } else {
                $newID = (string)((int)$lastDataWaliKelas['wk_id'] + 1);
            }
            $data = [
                'wk_id' => $newID,
                'wk_guru_id' => $dtGuru['guru_id'],
                'wk_kelas_id' => $dtKelas['kelas_id'],
                'wk_th_id' => $dtTA['th_id'],
                'wk_updated_by' => session('log_auth')['accountID'],
                'wk_created_by' => session('log_auth')['accountID']
            ];
            $this->M_wali_kelas->insert($data);
            $after = $this->M_wali_kelas->where('wk_kelas_id', $dtKelas['kelas_id'])
                ->where('wk_th_id', $dtTA['th_id'])
                ->first();
            if (!empty($after)) {
                return $this->redirectBackWithAlert('Data wali kelas berhasil ditambahkan', 'success');
            } else {
                return $this->redirectBackWithAlert('Data wali kelas gagal ditambahkan');
            }
        } else {
            $data = [
                'wk_guru_id' => $dtGuru['guru_id'],
                'wk_updated_by' => session('log_auth')['accountID']
            ];
            $this->M_wali_kelas->update($dtWali['wk_id'], $data);
            $after = $this->M_wali_kelas->where('wk_kelas_id', $dtKelas['kelas_id'])
                ->where('wk_th_id', $dtTA['th_id'])
                ->first();
            if ($after['wk_guru_id'] != $dtWali['wk_guru_id']) {
                return $this->redirectBackWithAlert('Data wali kelas berhasil dirubah', 'success');
            } else {
                return $this->redirectBackWithAlert('Data wali kelas gagal dirubah');
            }
        }
    }
}
