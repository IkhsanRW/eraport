<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKelas;
use App\Models\ModelSiswa;

class Naikkelas extends BaseController
{
    private $M_kelas;
    private $M_siswa;

    public function __construct()
    {
        helper('form');
        $this->M_kelas = new ModelKelas();
        $this->M_siswa = new ModelSiswa();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelas',
            'title_content' => 'Kenaikan Kelas',
            'dt_kelas' => $this->M_kelas->where('kelas_grade <>', '12')->findAll(),
        ];
        return view('admin/kelas/naik_kelas', $data);
    }

    public function add_siswa($id_kelas)
    {
        // Validate kelas
        $dtKelas = $this->M_kelas->where('kelas_grade <>', '12')->where('kelas_id', $id_kelas)->first();
        if (empty($dtKelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak ditemukan');
        }
        $data = [
            'title' => 'Kelas',
            'title_content' => 'Manajemen Data Siswa',
            'dt_siswa' => $this->M_siswa->where('siswa_kelas_sekarang', $id_kelas)->findAll(),
            'id_kelas' => $id_kelas
        ];
        return view('admin/kelas/add_naik_kelas', $data);
    }

    public function proses($id_kelas)
    {
        // Validate
        if (is_null($id_kelas) || !is_numeric($id_kelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak valid');
        }
        $dtKelas = $this->M_kelas->where('kelas_id', $id_kelas)
            ->where('kelas_grade <>', '12')
            ->first();
        if (empty($dtKelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak ditemukan');
        }
        $nextKelas = null;
        foreach ($this->M_kelas->getClassFlow() as $key => $val) {
            if ((int)$id_kelas == $key) {
                $nextKelas = $val;
                break;
            }
        }
        if (is_null($nextKelas)) {
            return $this->redirectBackWithAlert('Data kelas eror');
        }
        if (!$this->validate([
            'pilih_siswa' => 'required'
        ])) {
            return $this->redirectBackWithAlert('Data siswa wajib dimasukan');
        }
        if (!is_array($this->request->getPost('pilih_siswa'))) {
            return $this->redirectBackWithAlert('Data siswa tidak valid');
        }
        // End validate
        $fail = [];
        $success = [];
        foreach ($this->request->getPost('pilih_siswa') as $siswa) {
            if (!is_null($siswa) && is_numeric($siswa)) {
                $dtSiswa = $this->M_siswa->where('siswa_nis', $siswa)->first();
                if (!empty($dtSiswa)) {
                    if ($dtSiswa['siswa_kelas_sekarang'] != $id_kelas) {
                        array_push($fail, [
                            'NIS' => $dtSiswa['siswa_nis'],
                            'Nama' => '-',
                            'Keterangan' => 'Data kelas tidak sesuai'
                        ]);
                    } else {
                        $data = [
                            'siswa_kelas_sekarang' => $nextKelas,
                            'siswa_updated_by' => session('log_auth')['accountID']
                        ];
                        $this->M_siswa->update($dtSiswa['siswa_id'], $data);
                        $after = $this->M_siswa->where('siswa_nis', $siswa)->first();
                        if ($dtSiswa['siswa_kelas_sekarang'] != $after['siswa_kelas_sekarang']) {
                            array_push($success, [
                                'NIS' => $dtSiswa['siswa_nis'],
                                'Nama' => $dtSiswa['siswa_nama'],
                                'Keterangan' => '-'
                            ]);
                        } else {
                            array_push($fail, [
                                'NIS' => $dtSiswa['siswa_nis'],
                                'Nama' => $dtSiswa['siswa_nama'],
                                'Keterangan' => 'Kesalahan Sistem'
                            ]);
                        }
                    }
                }
            }
        }
        if (count($fail) == 0 && count($success) == 0) {
            return $this->redirectBackWithAlert('Tidak ada data siswa yang terubah');
        } else {
            session()->setFlashdata('log_naik_kelas', [
                'success' => $success,
                'fail' => $fail
            ]);
            if (count($success) == count($this->request->getPost('pilih_siswa'))) {
                return $this->redirectBackWithAlert('Semua data siswa berhasil terubah', 'success');
            } else {
                return $this->redirectBackWithAlert('Data berhasil dirubah ' . count($success) . '. Data yang gagal dirubah ' . count($fail), 'warning');
            }
        }
    }
}
