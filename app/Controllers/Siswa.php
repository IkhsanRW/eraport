<?php

namespace App\Controllers;

use App\Models\ModelSiswa;
use App\Models\ModelAccount;
use App\Models\ModelKelas;
use App\Models\ModelOrtu;
use App\Models\ModelWali;
use Exception;

class Siswa extends BaseController
{
    private $M_siswa;
    private $M_akun;
    private $M_ortu;
    private $M_kelas;
    private $M_wali;

    public function __construct()
    {
        $this->M_siswa = new ModelSiswa();
        $this->M_akun = new ModelAccount();
        $this->M_ortu = new ModelOrtu();
        $this->M_kelas = new ModelKelas();
        $this->M_wali = new ModelWali();
        helper('form');
    }
    //view index
    public function index(): string
    {
        $data = [
            'title' => 'Siswa',
            'title_content' => 'Manajemen Siswa',
            'dt_siswa' => $this->M_siswa->join('tb_account', 'siswa_account_id = account_id')->findAll()
        ];
        return view('admin/siswa/index', $data);
    }
    //view tambah siswa
    public function tambahSiswa()
    {
        $data = [
            'title' => 'Siswa',
            'agama' => $this->agama,
            'title_content' => 'Tambah Data Siswa',
            'dt_kelas' => $this->M_kelas->findAll(),
            'patternDate' => $this->patternDateIdn()
        ];
        return view('admin/siswa/add_siswa', $data);
    }
    //view tambah ortu
    public function ortu()
    {
        $id_siswa = session('data_user')['id_siswa'];
        $data = [
            'title' => 'Orang Tua',
            'title_content' => 'Tambah Data Orang Tua',
            'dt_ortu' => $this->M_ortu->where('ortu_siswa_id', $id_siswa)->first()
        ];
        return view('admin/siswa/add_ortu', $data);
    }
    //view detail siswa
    public function detailSiswa($siswa_nis)
    {
        helper('date');
        $data = [
            'title' => 'Detail Siswa',
            'title_content' => 'Detail Data Siswa',
            'dt_siswa' => $this->M_siswa->where('siswa_nis', $siswa_nis)->first(),
            'agama' => $this->agama,
            'dt_kelas' => $this->M_kelas->findAll()

        ];
        return view('admin/siswa/detail_siswa', $data);
    }
    public function detailOrtu($siswa_nis)
    {
        $id_siswa = $this->M_siswa->select('siswa_id')->where('siswa_nis', $siswa_nis)->first();
        $data = [
            'title' => 'Detail Ortu',
            'title_content' => 'Detail Data Orang Tua',
            'dt_ortu' => $this->M_ortu->where('ortu_siswa_id', $id_siswa)->first(),
            'dt_wali' => $this->M_wali->where('wali_siswa_id', $id_siswa)->first(),
            'id_siswa' => $id_siswa

        ];
        return view('admin/siswa/detail_ortu', $data);
    }
    //tambah data siswa & akun
    public function insertData()
    {
        helper('date');
        helper('agama');
        $id_user = session('log_auth')['accountID'];
        // Validate
        if (!$this->validate([
            'txt_nis' => 'required|is_unique[tb_siswa.siswa_nis]|is_natural_no_zero|max_length[10]',
            'txt_nisn' => 'required|is_unique[tb_siswa.siswa_nisn]|is_natural_no_zero|max_length[15]',
            'txt_nama' => 'required|max_length[100]',
            'txt_tempat_lahir' => 'required|max_length[100]',
            'txt_tanggal_lahir' => 'required|valid_date[d F Y]',
            'txt_jenis_kelamin' => 'required|in_list[Laki-Laki,Perempuan]',
            'txt_agama' => 'required|' . getValidateList(),
            'txt_anak_ke' => 'required|is_natural_no_zero',
            'txt_alamat' => 'required',
            'txt_telepon' => 'required|numeric|max_length[15]',
            'txt_sekolah_asal' => 'required',
            'txt_alamat_sekolah_asal' => 'required',
            'txt_kelas_awal' => 'required|is_natural_no_zero',
            'txt_kelas_sekarang' => 'required|is_natural_no_zero',
            'txt_tanggal_diterima' => 'required|valid_date[d F Y]'
        ])) {
            session()->setFlashdata('log_valid_input', $this->validator);
            return redirect()->to(base_url('siswa/tambahSiswa'))->withInput()->with('danger', 'Data siswa tidak valid');
        }
        if (!$this->validate([
            'txt_foto' => 'uploaded[txt_foto]|is_image[txt_foto]'
        ])) {
            return redirect()->to(base_url('siswa/tambahSiswa'))->withInput()->with('danger', 'Data foto tidak valid');
        }
        // End Validate
        $file = $this->request->getFile('txt_foto');
        $nama_file = $file->getRandomName();
        $cekAccount = $this->M_akun->where('account_username', $this->request->getPost('txt_nis'))
            ->where('account_password', md5((string)$this->request->getPost('txt_nisn')))
            ->first();
        if (!empty($cekAccount)) {
            return redirect()->to(base_url('siswa/tambahSiswa'))->withInput()->with('danger', 'NIS dan NISN telah digunakan akun lain');
        }
        $data_akun = [
            'account_username' => $this->request->getPost('txt_nis'),
            'account_password' =>  md5((string)$this->request->getPost('txt_nisn')),
            'account_role_id'  => '3',
            'account_created_at' => date('Y-m-d H:i:s'),
            'account_created_by' => $id_user

        ];
        $this->M_akun->insert($data_akun);
        $afterAccount = $this->M_akun->where('account_username', $this->request->getPost('txt_nis'))
            ->where('account_password', md5((string)$this->request->getPost('txt_nisn')))
            ->first();
        if (empty($afterAccount)) {
            return redirect()->to(base_url('siswa/tambahSiswa'))->withInput()->with('danger', 'Akun gagal dibuat karena kesalahan sistem');
        }
        $id_akun = $afterAccount['account_id'];
        if (validateDate(str_replace(" ", "", (string)$this->request->getPost('txt_tanggal_lahir')), "d F Y")) {
            return redirect()->to(base_url('siswa/tambahSiswa'))->withInput()->with('danger', "Tanggal lahir tidak valid");
        }

        if (validateDate(str_replace(" ", "", (string)$this->request->getPost('txt_tanggal_diterima')), "d F Y")) {
            return redirect()->to(base_url('siswa/tambahSiswa'))->withInput()->with('danger', "Tanggal diterima tidak valid");
        }
        $data_siswa = [
            'siswa_nis' => $this->request->getPost('txt_nis'),
            'siswa_nisn' => $this->request->getPost('txt_nisn'),
            'siswa_nama' => $this->request->getPost('txt_nama'),
            'siswa_tempat_lahir' => $this->request->getPost('txt_tempat_lahir'),
            'siswa_tanggal_lahir' => normalizeDate((string)$this->request->getPost('txt_tanggal_lahir'), "Y-m-d"),
            'siswa_jenis_kelamin' => $this->request->getPost('txt_jenis_kelamin'),
            'siswa_agama' => $this->request->getPost('txt_agama'),
            'siswa_status_dalam_keluarga' => $this->request->getPost('txt_status_keluarga'),
            'siswa_anak_ke' => $this->request->getPost('txt_anak_ke'),
            'siswa_alamat' => $this->request->getPost('txt_alamat'),
            'siswa_telepon' => $this->request->getPost('txt_telepon'),
            'siswa_sekolah_asal' => $this->request->getPost('txt_sekolah_asal'),
            'siswa_alamat_sekolah_asal' => $this->request->getPost('txt_alamat_sekolah_asal'),
            'siswa_kelas_awal' => $this->request->getPost('txt_kelas_awal'),
            'siswa_kelas_sekarang' => $this->request->getPost('txt_kelas_sekarang'),
            'siswa_tanggal_diterima' => normalizeDate((string)$this->request->getPost('txt_tanggal_diterima'), "Y-m-d"),
            'siswa_foto' => $nama_file,
            'siswa_account_id' => $id_akun,
            'siswa_created_by' => $id_user
        ];
        $this->M_siswa->insert($data_siswa);
        $afterSiswa = $this->M_siswa->where('siswa_nis', $this->request->getPost('txt_nis'))->first();
        if (empty($afterSiswa)) {
            $this->M_akun->delete($id_akun);
            return redirect()->to(base_url('siswa/tambahSiswa'))->withInput()->with('danger', "Data siswa gagal dimasukan karena kesalahan sistem");
        }
        $file->move('foto_siswa/', $nama_file);
        if ($file->hasMoved()) {
            $statusFoto = "Foto berhasil ditambahkan";
        } else {
            $statusFoto = "Foto gagal ditambahkan";
        }
        $id_siswa = $afterSiswa['siswa_id'];
        $dt = [
            'id_siswa' =>  $id_siswa,
        ];
        session()->set('data_user', $dt);
        return redirect()->to('siswa/ortu')->with('success', 'Data berhasil Ditambahkan. ' . $statusFoto);
    }
    //tambah data ortu & wali
    public function insertOrtu()
    {
        $id_siswa = session('data_user')['id_siswa'];
        $data_ortu = [
            'ortu_ayah' => $this->request->getPost('ortu_ayah'),
            'ortu_ibu' => $this->request->getPost('ortu_ibu'),
            'ortu_alamat' => $this->request->getPost('ortu_alamat'),
            'ortu_telepon' => $this->request->getPost('ortu_telepon'),
            'ortu_pekerjaan_ayah' => $this->request->getPost('ortu_pekerjaan_ayah'),
            'ortu_pekerjaan_ibu' => $this->request->getPost('ortu_pekerjaan_ibu'),
            'ortu_siswa_id' => $id_siswa,
            'ortu_created_at' => date('Y-m-d H:i:s'),
            'ortu_created_by' => 1
        ];
        $this->M_ortu->insert($data_ortu);
        $data_wali = [
            'wali_nama' => $this->request->getPost('wali_nama'),
            'wali_alamat' => $this->request->getPost('wali_alamat'),
            'wali_telepon' => $this->request->getPost('wali_telepon'),
            'wali_pekerjaan' => $this->request->getPost('wali_pekerjaan'),
            'wali_siswa_id' => $id_siswa,
            'wali_created_at' => date('Y-m-d H:i:s'),
            'wali_created_by' => 1
        ];
        $this->M_wali->insert($data_wali);
        return redirect()->to('siswa')->with('success', 'Data berhasil Ditambahkan');
    }
    public function editDataSiswa($siswa_id)
    {
        $file = $this->request->getFile('txt_foto');
        if ($file->getError() == 4) {
            $data = [
                'siswa_nis' => $this->request->getPost('txt_nis'),
                'siswa_nisn' => $this->request->getPost('txt_nisn'),
                'siswa_nama' => $this->request->getPost('txt_nama'),
                'siswa_tempat_lahir' => $this->request->getPost('txt_tempat_lahir'),
                'siswa_tanggal_lahir' => $this->request->getPost('txt_tanggal_lahir'),
                'siswa_jenis_kelamin' => $this->request->getPost('txt_jenis_kelamin'),
                'siswa_agama' => $this->request->getPost('txt_agama'),
                'siswa_status_dalam_keluarga' => $this->request->getPost('txt_status_keluarga'),
                'siswa_anak_ke' => $this->request->getPost('txt_anak_ke'),
                'siswa_alamat' => $this->request->getPost('txt_alamat'),
                'siswa_telepon' => $this->request->getPost('txt_telepon'),
                'siswa_sekolah_asal' => $this->request->getPost('txt_sekolah_asal'),
                'siswa_alamat_sekolah_asal' => $this->request->getPost('txt_alamat_sekolah_asal'),
                'siswa_kelas_awal' => $this->request->getPost('txt_kelas_awal'),
                'siswa_kelas_sekarang' => $this->request->getPost('txt_kelas_sekarang'),

            ];
            $this->M_siswa->update($siswa_id, $data);
        } else {
            // jika foto diganti
            $foto_siswa = $this->M_siswa->where('siswa_id', $siswa_id)->get()->getRowArray();
            if ($foto_siswa['siswa_foto'] != "") {
                try {
                    unlink('./foto_siswa/' . $foto_siswa['siswa_foto']);
                } catch (Exception $e) {
                }
            }
            $nama_file = $file->getRandomName();

            $data = [
                'siswa_nis' => $this->request->getPost('txt_nis'),
                'siswa_nisn' => $this->request->getPost('txt_nisn'),
                'siswa_nama' => $this->request->getPost('txt_nama'),
                'siswa_tempat_lahir' => $this->request->getPost('txt_tempat_lahir'),
                'siswa_tanggal_lahir' => $this->request->getPost('txt_tanggal_lahir'),
                'siswa_jenis_kelamin' => $this->request->getPost('txt_jenis_kelamin'),
                'siswa_agama' => $this->request->getPost('txt_agama'),
                'siswa_status_dalam_keluarga' => $this->request->getPost('txt_status_keluarga'),
                'siswa_anak_ke' => $this->request->getPost('txt_anak_ke'),
                'siswa_alamat' => $this->request->getPost('txt_alamat'),
                'siswa_telepon' => $this->request->getPost('txt_telepon'),
                'siswa_sekolah_asal' => $this->request->getPost('txt_sekolah_asal'),
                'siswa_alamat_sekolah_asal' => $this->request->getPost('txt_alamat_sekolah_asal'),
                'siswa_kelas_awal' => $this->request->getPost('txt_kelas_awal'),
                'siswa_kelas_sekarang' => $this->request->getPost('txt_kelas_sekarang'),
                'siswa_foto' => $nama_file
            ];
            $file->move('foto_siswa/', $nama_file);
            $this->M_siswa->update($siswa_id, $data);
        }
        return redirect()->to('siswa')->with('success', 'Data berhasil diedit');
    }
    public function editAkunSiswa($account_id)
    {
        $data_akun = [
            'account_username' => $this->request->getPost('account_username'),
            'account_password' =>  md5((string)$this->request->getPost('account_password')),
            'account_updated_at' => date('Y-m-d H:i:s')
        ];
        // dd($data_akun);
        $this->M_akun->update($account_id, $data_akun);
        return redirect()->to('siswa')->with('success', 'Data akun berhasil diedit');
    }
    public function deleteData($siswa_id)
    {
        $akun = $this->M_siswa->where('siswa_id', $siswa_id)->first();
        if ($akun['siswa_foto'] != "") {
            unlink('./foto_siswa/' . $akun['siswa_foto']);
        }
        $this->M_siswa->delete($siswa_id);
        $this->M_akun->delete($akun['siswa_account_id']);
        return redirect()->to(base_url('siswa'))->with('danger', 'Data berhasil dihapus');
    }

    //kurang edit
    public function editdataOrtu($id_siswa)
    {
        $id_ortu = $this->M_ortu->where('ortu_siswa_id', $id_siswa)->first();
        $id_wali = $this->M_wali->where('wali_siswa_id', $id_siswa)->first();
        if (empty($id_ortu)) {
            $data_ortu = [
                'ortu_ayah' => $this->request->getPost('ortu_ayah'),
                'ortu_ibu' => $this->request->getPost('ortu_ibu'),
                'ortu_alamat' => $this->request->getPost('ortu_alamat'),
                'ortu_telepon' => $this->request->getPost('ortu_telepon'),
                'ortu_pekerjaan_ayah' => $this->request->getPost('ortu_pekerjaan_ayah'),
                'ortu_pekerjaan_ibu' => $this->request->getPost('ortu_pekerjaan_ibu'),
                'ortu_siswa_id' => $id_siswa,
                'ortu_created_at' => date('Y-m-d H:i:s'),
                'ortu_created_by' => 1
            ];
            $this->M_ortu->insert($data_ortu);
        } else {
            $data_ortu = [
                'ortu_ayah' => $this->request->getPost('ortu_ayah'),
                'ortu_ibu' => $this->request->getPost('ortu_ibu'),
                'ortu_alamat' => $this->request->getPost('ortu_alamat'),
                'ortu_telepon' => $this->request->getPost('ortu_telepon'),
                'ortu_pekerjaan_ayah' => $this->request->getPost('ortu_pekerjaan_ayah'),
                'ortu_pekerjaan_ibu' => $this->request->getPost('ortu_pekerjaan_ibu'),
                'ortu_updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->M_ortu->update($id_ortu['ortu_id'], $data_ortu);
        }
        if (empty($id_wali)) {
            $data_wali = [
                'wali_nama' => $this->request->getPost('wali_nama'),
                'wali_alamat' => $this->request->getPost('wali_alamat'),
                'wali_telepon' => $this->request->getPost('wali_telepon'),
                'wali_pekerjaan' => $this->request->getPost('wali_pekerjaan'),
                'wali_siswa_id' => $id_siswa,
                'wali_created_at' => date('Y-m-d H:i:s'),
                'wali_created_by' => 1
            ];
            $this->M_wali->insert($data_wali);
        } else {
            $data_wali = [
                'wali_nama' => $this->request->getPost('wali_nama'),
                'wali_alamat' => $this->request->getPost('wali_alamat'),
                'wali_telepon' => $this->request->getPost('wali_telepon'),
                'wali_pekerjaan' => $this->request->getPost('wali_pekerjaan'),
                'wali_siswa_id' => $id_siswa,
            ];
            $this->M_wali->update($id_wali['wali_id'], $data_wali);
        }
        return redirect()->to(base_url('siswa'))->with('success', 'Data berhasil diubah');
    }
}
