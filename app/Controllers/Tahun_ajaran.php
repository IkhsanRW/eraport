<?php

namespace App\Controllers;

use App\Models\ModelSemester;
use App\Models\ModelTahunAjar;

class Tahun_ajaran extends BaseController
{
    private $M_th_ajar;
    private $M_semester;
    public function __construct()
    {
        $this->M_th_ajar = new ModelTahunAjar();
        $this->M_semester = new ModelSemester();
        helper('form');
    }
    public function index(): string
    {
        $data = [
            'title' => 'Tahun Ajaran',
            'title_content' => 'Manajemen Tahun Ajaran',
            'th_ajar' => $this->M_th_ajar->orderBy('th_id', 'desc')->findAll(),
            'semester' => $this->M_semester->select('semester_th_id as tahunAjaran, semester_nama as semester, semester_start_at as mulai, semester_finish_at as selesai')->findAll(),
            'isFinished' => $this->M_th_ajar->isFinished()
        ];
        return view('admin/tahun_ajaran/index', $data);
    }
    public function insertData()
    {
        if (!$this->validate([
            'tahun_ajaran' => 'required|is_unique[tb_tahun_ajar.th_nama]'
        ])) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Tahun ajaran harus diisi dan tidak boleh sama. (Unique value)');
        }
        if (!is_null($this->M_th_ajar->getTANow())) {
            $dtTA_before = $this->M_th_ajar->getTANow();
            foreach ($this->M_semester->where('semester_th_id', $dtTA_before['th_id'])->findAll() as $dt) {
                if (is_null($dt['semester_start_at'])) {
                    $data = [
                        'semester_start_at' => date('Y-m-d H:i:s'),
                        'semester_created_at' => date('Y-m-d H:i:s'),
                        'semester_created_by' => session('log_auth')['accountID']
                    ];
                    $this->M_semester->update($dt['semester_id'], $data);
                }
                if (is_null($dt['semester_finish_at'])) {
                    $data = [
                        'semester_finish_at' => date('Y-m-d H:i:s'),
                        'semester_updated_at' => date('Y-m-d H:i:s'),
                        'semester_updated_by' => session('log_auth')['accountID']
                    ];
                    $this->M_semester->update($dt['semester_id'], $data);
                }
            }
        }
        $data = [
            'th_nama' => $this->request->getPost('tahun_ajaran'),
            'th_created_at' => date('Y-m-d H:i:s'),
            'th_created_by' => session('log_auth')['accountID']
        ];
        if ($this->M_th_ajar->insert($data)) {
            $idTA = $this->M_th_ajar->orderBy('th_id', 'DESC')->first()['th_id'];
            $data = [
                'semester_th_id' => $idTA,
                'semestera_nama' => '1',
                'semester_created_by' => session('log_auth')['accountID']

            ];
            if ($this->M_semester->insert($data)) {
                $data['semester_nama'] = '2';
                if ($this->M_semester->insert($data)) {
                    return redirect()->to('tahun_ajaran')->with('success', 'Data berhasil ditambahkan');
                } else {
                    return redirect()->to('tahun_ajaran')->with('danger', 'Gagal menambahkan data semester genap');
                }
            } else {
                return redirect()->to('tahun_ajaran')->with('danger', 'Gagal menambahkan data semester ganjil');
            }
        }
        return redirect()->to('tahun_ajaran')->with('danger', 'Gagal menambahkan data tahun ajaran');
    }
    public function startSemester()
    {
        // Cek data tahun ajaran
        $dtTA = $this->M_th_ajar->getTANow();
        if (empty($dtTA)) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Data tahun ajaran belum ada');
        }
        if ($this->M_th_ajar->isFinished()) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Akses edit data tahun ajaran telah ditutup!');
        }
        // Get data semester by tahun ajaran
        $dtSemester = $this->M_semester->where('semester_th_id', $dtTA['th_id'])->findAll();
        if (count($dtSemester) == 0) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Data tsemester tidak ditemukan');
        }
        foreach ($dtSemester as $dt) {
            if (strtolower($dt['semester_nama']) == '1') {
                if ($dt['semester_start_at'] == null) {
                    $data = [
                        'semester_start_at' => date("Y-m-d H:i:s"),
                        'semester_created_by' => session('log_auth')['accountID']
                    ];
                    if ($this->M_semester->update($dt['semester_id'], $data)) {
                        return redirect()->to(base_url('tahun_ajaran'))->with('success', 'Semester ganjil tahun ajaran ' . $dtTA['th_nama'] . ' berhasil dimulai');
                    } else {
                        return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Semester ganjil tahun ajaran ' . $dtTA['th_nama'] . ' gagal dimulai');
                    }
                }
            } else {
                $dtGanjil = $this->M_semester->where('semester_nama', '1')->where('semester_th_id', $dtTA['th_id'])->first();
                if (is_null($dtGanjil['semester_finish_at'])) {
                    $data = [
                        'semester_finish_at' => date('Y-m-d H:i:s'),
                        'semester_updated_at' => session('log_auth')['accountID']
                    ];
                    $this->M_semester->update($dtGanjil['semester_id'], $data);
                }
                $data = [
                    'semester_start_at' => date('Y-m-d H:i:s'),
                    'semester_created_by' => session('log_auth')['accountID']
                ];
                if ($dt['semester_start_at'] == null) {
                    $data = [
                        'semester_start_at' => date("Y-m-d H:i:s"),
                        'semester_created_by' => session('log_auth')['accountID']
                    ];
                    if ($this->M_semester->update($dt['semester_id'], $data)) {
                        return redirect()->to(base_url('tahun_ajaran'))->with('success', 'Semester genap tahun ajaran ' . $dtTA['th_nama'] . ' berhasil dimulai');
                    } else {
                        return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Semester genap tahun ajaran ' . $dtTA['th_nama'] . ' gagal dimulai');
                    }
                }
            }
        }
    }
    public function finishSemester()
    {
        // Cek data tahun ajaran
        $dtTA = $this->M_th_ajar->getTANow();
        if (empty($dtTA)) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Data tahun ajaran belum  ada');
        }
        if ($this->M_th_ajar->isFinished()) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Akses edit data tahun ajaran telah ditutup!');
        }
        // Get data semester by tahun ajaran
        $dtSemester = $this->M_semester->where('semester_th_id', $dtTA['th_id'])->findAll();
        if (count($dtSemester) == 0) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Data semester tidak ditemukan');
        }
        foreach ($dtSemester as $dt) {
            if (!is_null($dt['semester_start_at'])) {
                if ($dt['semester_finish_at'] == null) {
                    $data = [
                        'semester_finish_at' => date('Y-m-d H:i:s'),
                        'semester_updated_by' => session('log_auth')['accountID']
                    ];
                    if ($this->M_semester->update($dt['semester_id'], $data)) {
                        return redirect()->to(base_url('tahun_ajaran'))->with('success', 'Semester ' . $dt['semester_nama'] . ' tahun ajaran ' . $dtTA['th_nama'] . ' berhasil diselesaikan');
                    } else {
                        return redirect()->to(base_url('tahun_ajaran'))->with('success', 'Semester ' . $dt['semester_nama'] . ' tahun ajaran ' . $dtTA['th_nama'] . ' gagal diselesaikan');
                    }
                }
            }
        }
        return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Tidak ditemukan data semester yang dapat diselsaikan');
    }
    public function editdata($id)
    {
        // Cek data tahun ajaran
        $dtTA = $this->M_th_ajar->getTANow();
        if (empty($dtTA)) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Data tahun ajaran belum  ada');
        }
        if ($this->M_th_ajar->isFinished()) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Akses edit data tahun ajaran telah ditutup!');
        }
        if ($id != $this->M_th_ajar->getTANow()['th_id']) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Anda hanya dapat mengedit tahun ajaran saat ini saja');
        }
        if (!$this->validate([
            'tahun_ajaran' => 'required|is_unique[tb_tahun_ajar.th_nama]'
        ])) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Tahun ajaran harus diisi dan tidak boleh sama. (Unique value)');
        }
        $data = [
            'th_nama' => $this->request->getPost('tahun_ajaran'),
            'th_updated_at' => date('Y-m-d H:i:s'),
            'th_updated_by' => session('log_auth')['accountID']
        ];
        $this->M_th_ajar->update($id, $data);
        return redirect()->to('tahun_ajaran')->with('success', 'Data berhasil diubah');
    }

    public function deleteData($id)
    {
        if ($this->M_th_ajar->isFinished()) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Akses edit data tahun ajaran telah ditutup!');
        }
        if ($id != $this->M_th_ajar->getTANow()['th_id']) {
            return redirect()->to(base_url('tahun_ajaran'))->with('danger', 'Anda hanya dapat mengedit tahun ajaran saat ini saja');
        }
        // Data semester tidak dihapus melalui program karena pada relasi sudah menggunakan CASCADE on DELETE
        $this->M_th_ajar->delete($id);
        return redirect()->to('tahun_ajaran')->with('success', 'Data berhasil dihapus');
    }
}
