<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelGuruMapel;
use App\Models\ModelKelas;
use App\Models\ModelNilai;
use App\Models\ModelSemester;
use App\Models\ModelSiswa;
use App\Models\ModelTahunAjar;
use App\Models\ModelWaliKelas;

class Raport extends BaseController
{
    private $M_siswa;
    private $M_kelas;
    private $M_tahun_ajar;
    private $M_guru_mapel;
    private $M_nilai;
    private $M_semester;
    private $M_wali_kelas;

    function __construct()
    {
        $this->M_siswa = new ModelSiswa();
        $this->M_kelas = new ModelKelas();
        $this->M_tahun_ajar = new ModelTahunAjar();
        $this->M_guru_mapel = new ModelGuruMapel();
        $this->M_nilai = new ModelNilai();
        $this->M_semester = new ModelSemester();
        $this->M_wali_kelas = new ModelWaliKelas();
    }

    public function index()
    {
        $data = [
            'title' => 'Raport',
            'title_content' => 'Raport',
            'dt_th' => $this->M_tahun_ajar->findAll(),
        ];
        return view('admin/raport/index.php', $data);
    }

    public function kelas($idTA = null)
    {
        if ($idTA == null || trim($idTA) == "") {
            $dtTA = $this->M_tahun_ajar->getTANow();
        } else {
            try {
                if ((int)$idTA < 1) {
                    return $this->redirectBack('Data tahun ajaran tidak valid');
                } else {
                    $dtTA = $this->M_tahun_ajar->find($idTA);
                }
            } catch (\Throwable $th) {
                return $this->redirectBack('Data tahun ajaran tidak valid');
            }
        }
        if (empty($dtTA)) {
            return $this->redirectBack('Data tahun ajaran tidak valid');
        }
        $data = [
            'title' => 'Raport',
            'title_content' => 'Raport',
            'dt_kelas' => $this->M_kelas->findAll(),
            'dt_ta' => $dtTA
        ];
        return view('admin/raport/pilih_kelas.php', $data);
    }

    public function preview_bio($siswa_nis)
    {
        $dtSiswa = $this->M_siswa
            ->join('tb_wali_siswa', 'siswa_id = wali_siswa_id', 'left')
            ->join('tb_ortu_siswa', 'siswa_id = ortu_siswa_id', 'left')
            ->join('tb_kelas', 'siswa_kelas_awal = kelas_id')
            ->where('siswa_nis', $siswa_nis)
            ->first();
        if (empty($dtSiswa)) {
            return $this->redirectBackWithAlert('Data siswa tidak ditemukan');
        }
        if (session('log_auth')['accountRole'] == '3') {
            $cekSiswa = $this->M_siswa->where('siswa_account_id', session('log_auth')['accountID'])->first();
            if ($cekSiswa['siswa_nis'] != $siswa_nis) {
                return $this->redirectBackWithAlert('Akses ditolak');
            }
        } elseif (session('log_auth')['accountRole'] == '2') {
        }
        $data = [
            'title' => 'Raport',
            'title_content' => 'Preview Bio Siswa',
            'dtSiswa' => $dtSiswa,
        ];
        return view('admin/raport/preview_bio.php', $data);
    }

    public function preview_raport($kelas, $idTA, $semester, $siswa_nis)
    {
        $dtSiswa = $this->M_siswa->where('siswa_nis', $siswa_nis)->first();
        if (empty($dtSiswa)) {
            return $this->redirectBackWithAlert('Data siswa tidak ditemukan');
        }
        $dtSemester = $this->M_semester->where('semester_th_id', $idTA)->where('semester_nama', $semester)->first();
        $dtNilai = $this->M_nilai
            ->join('tb_guru_mapel', 'nilai_gm_id = gm_id')
            ->join('tb_mapel', 'gm_mapel_id = mapel_id')
            ->where('gm_th_id', $idTA)
            ->where('nilai_siswa_id', $dtSiswa['siswa_id'])
            ->where('nilai_semester_id', $dtSemester['semester_id'])
            ->groupBy('gm_mapel_id')
            ->findAll();
        $tmpNilai = [];
        foreach ($dtNilai as $dt) {
            $tmpNilai[$dt['gm_mapel_id']] = [
                'np' => $dt['nilai_pengetahuan'],
                'nk' => $dt['nilai_keterampilan']
            ];
        }
        $listMapel = $this->M_guru_mapel->join('tb_mapel', 'gm_mapel_id = mapel_id')
            ->where('gm_th_id', $idTA)
            ->where('gm_kelas_id', $kelas)
            ->findAll();
        $data = [
            'title' => 'Raport',
            'title_content' => 'Preview Raport Siswa',
            'dt_nilai' => $tmpNilai,
            'dt_siswa' => $dtSiswa,
            'listMapel' => $listMapel,
            'dt_ta' => $this->M_tahun_ajar->find($idTA),
            'dt_kelas' => $this->M_kelas->find($kelas)
        ];
        return view('admin/raport/preview_raport.php', $data);
    }

    public function detail_kelas($id_kelas, $idTA = null)
    {
        if ($idTA != null && trim($idTA) != "") {
            try {
                if ((int)$idTA < 1) {
                    return $this->redirectBackWithAlert('Tahun ajaran tidak valid');
                }
            } catch (\Throwable $th) {
                return $this->redirectBackWithAlert('Tahun ajaran tidak valid');
            }
            $dtTA = $this->M_tahun_ajar->find($idTA);
            if (empty($dtTA)) {
                return $this->redirectBackWithAlert('Data tahun ajaran tidak ditemukan');
            }
            $dtSiswa = $this->M_nilai->select('tb_siswa.*')
                ->join('tb_guru_mapel', 'nilai_gm_id = gm_id')
                ->join('tb_siswa', 'nilai_siswa_id = siswa_id')
                ->groupBy('nilai_siswa_id')
                ->where('gm_th_id', $idTA)
                ->where('gm_kelas_id', $id_kelas)
                ->findAll();
        } else {
            $dtTA = $this->M_tahun_ajar->getTANow();
            if (empty($dtTA)) {
                return $this->redirectBackWithAlert('Data tahun ajaran masih kosong');
            }
            $dtSiswa = $this->M_siswa->where('siswa_kelas_sekarang', $id_kelas)->findAll();
        }

        $dtWaliKelas = $this->M_wali_kelas
            ->join('tb_guru', 'wk_guru_id = guru_id')
            ->where('wk_th_id', $dtTA['th_id'])
            ->where('wk_kelas_id', $id_kelas)
            ->first();
        $data = [
            'title' => 'Raport',
            'title_content' => 'Data Siswa',
            'dt_kelas' => $this->M_kelas->find($id_kelas),
            'dt_wali_kelas' => $dtWaliKelas,
            'dt_siswa' => $dtSiswa,
            'dt_ta' => $dtTA,
            'id_kelas' => $id_kelas
        ];
        return view('admin/raport/detail_kelas.php', $data);
    }

    public function bio($siswa_nis)
    {
        $dtSiswa = $this->M_siswa
            ->join('tb_wali_siswa', 'siswa_id = wali_siswa_id', 'left')
            ->join('tb_ortu_siswa', 'siswa_id = ortu_siswa_id', 'left')
            ->join('tb_kelas', 'siswa_kelas_awal = kelas_id')
            ->where('siswa_nis', $siswa_nis)
            ->first();
        if (empty($dtSiswa)) {
            return $this->redirectBackWithAlert('Data siswa tidak ditemukan');
        }
        $data = [
            'title' => 'Print Biodata Raport',
            'title_content' => 'Print Raport',
            'dtSiswa' => $dtSiswa
        ];
        return view('admin/raport/print_bio_siswa.php', $data);
    }

    public function print_raport($kelas, $idTA, $semester, $siswa_nis)
    {
        $dtSiswa = $this->M_siswa->where('siswa_nis', $siswa_nis)->first();
        if (empty($dtSiswa)) {
            return $this->redirectBackWithAlert('Data siswa tidak ditemukan');
        }
        $dtSemester = $this->M_semester->where('semester_th_id', $idTA)->where('semester_nama', $semester)->first();
        $dtNilai = $this->M_nilai
            ->join('tb_guru_mapel', 'nilai_gm_id = gm_id')
            ->join('tb_mapel', 'gm_mapel_id = mapel_id')
            ->where('gm_th_id', $idTA)
            ->where('nilai_siswa_id', $dtSiswa['siswa_id'])
            ->where('nilai_semester_id', $dtSemester['semester_id'])
            ->groupBy('gm_mapel_id')
            ->findAll();
        $tmpNilai = [];
        foreach ($dtNilai as $dt) {
            $tmpNilai[$dt['gm_mapel_id']] = [
                'np' => $dt['nilai_pengetahuan'],
                'nk' => $dt['nilai_keterampilan']
            ];
        }
        $listMapel = $this->M_guru_mapel->join('tb_mapel', 'gm_mapel_id = mapel_id')
            ->where('gm_th_id', $idTA)
            ->where('gm_kelas_id', $kelas)
            ->findAll();
        $data = [
            'title' => 'Raport',
            'title_content' => 'Preview Raport Siswa',
            'dt_nilai' => $tmpNilai,
            'dt_siswa' => $dtSiswa,
            'listMapel' => $listMapel,
            'dt_ta' => $this->M_tahun_ajar->find($idTA),
            'dt_kelas' => $this->M_kelas->find($kelas)
        ];
        return view('admin/raport/print_raport.php', $data);
    }
}
