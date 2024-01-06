<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKelas;
use App\Models\ModelSiswa;
use App\Models\ModelTahunAjar;

class Lulus extends BaseController
{
    private $M_siswa;
    private $M_kelas;
    private $M_tahun_ajar;

    public function __construct()
    {
        helper('form');
        $this->M_siswa = new ModelSiswa();
        $this->M_kelas = new ModelKelas();
        $this->M_tahun_ajar = new ModelTahunAjar();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelulusan',
            'title_content' => 'Manajemen Kelulusan',
            'dt_kelas' => $this->M_kelas->where('kelas_grade', '12')->findAll(),
        ];
        return view('admin/lulus/index', $data);
    }

    public function add_siswa($id_kelas)
    {
        // Validate kelas
        $dtKelas = $this->M_kelas->where('kelas_grade', '12')->where('kelas_id', $id_kelas)->first();
        if (empty($dtKelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak ditemukan');
        }
        $data = [
            'title' => 'Kelulusan',
            'title_content' => 'Manajemen Kelulusan',
            'dt_siswa' => $this->M_siswa->where('siswa_kelas_sekarang', $id_kelas)->findAll(),
            'id_kelas' => $id_kelas,
            'dt_kelas' => $dtKelas,
            'th_ajaran' => $this->M_tahun_ajar->getTANow(),
        ];
        return view('admin/lulus/add_siswa', $data);
    }

    public function proses($id_kelas)
    {
        // Validate
        if (is_null($id_kelas) || !is_numeric($id_kelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak valid');
        }
        $dtKelas = $this->M_kelas->where('kelas_id', $id_kelas)
            ->where('kelas_grade', '12')
            ->first();
        if (empty($dtKelas)) {
            return $this->redirectBackWithAlert('Data kelas tidak ditemukan');
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
                        $this->M_siswa->delete($dtSiswa['siswa_id']);
                        $after = $this->M_siswa->where('siswa_nis', $siswa)->first();
                        if (empty($after)) {
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
        if (
            count($fail) == 0 && count($success) == 0
        ) {
            return $this->redirectBackWithAlert('Tidak ada data siswa yang terubah');
        } else {
            session()->setFlashdata('log_status_kelulusan', [
                'success' => $success,
                'fail' => $fail
            ]);
            if (count($success) == count($this->request->getPost('pilih_siswa'))) {
                return $this->redirectBackWithAlert('Semua data siswa berhasil diluluskan', 'success');
            } else {
                return $this->redirectBackWithAlert('Data berhasil diluluskan sebanyak ' . count($success) . '. Data yang gagal diluluskan sebanyak ' . count($fail), 'warning');
            }
        }
    }
}
