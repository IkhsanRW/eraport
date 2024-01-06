<?php

namespace App\Controllers;

use App\Models\ModelAccount;
use App\Models\ModelGuru;

class Guru extends BaseController
{
    private $M_guru;
    private $M_akun;

    public function __construct()
    {
        $this->M_guru = new ModelGuru();
        $this->M_akun = new ModelAccount();
        helper('form');
    }
    public function index(): string
    {
        $data = [
            'title' => 'Guru',
            'title_content' => 'Manajemen Guru',
            'dt_guru' => $this->M_guru->join('tb_account', 'guru_account_id = account_id')->findAll(),
        ];
        return view('admin/guru/index', $data);
    }
    //insert data akun & guru
    public function insertData()
    {
        $file = $this->request->getFile('guru_foto');
        $nip = $this->request->getPost('guru_nip');
        $nama_file = $file->getRandomName();
        $data_akun = [
            'account_username' => $nip,
            'account_password' =>  md5((string)$nip),
            'account_role_id'  => '2'
        ];
        $this->M_akun->insert($data_akun);
        $id_akun = $this->M_akun->orderBy('account_id', 'DESC')->first()['account_id'];

        $data_guru = [
            'guru_nip' => $nip,
            'guru_nama' => $this->request->getPost('guru_nama'),
            'guru_email' => $this->request->getPost('guru_email'),
            'guru_role' => $this->request->getPost('guru_role'),
            'guru_foto' => $nama_file,
            'guru_account_id' => $id_akun
        ];
        $file->move('foto_guru/', $nama_file);
        $this->M_guru->insert($data_guru);
        return redirect()->to('guru')->with('success', 'Data berhasil ditambahkan..!!');
    }
    //edit data guru
    public function editDataGuru($guru_id)
    {
        // jika foto tidak diganti
        $file = $this->request->getFile('guru_foto');
        if ($file->getError() == 4) {
            $data = [
                'guru_nip' => $this->request->getPost('guru_nip'),
                'guru_nama' => $this->request->getPost('guru_nama'),
                'guru_email' => $this->request->getPost('guru_email'),

            ];
            $this->M_guru->update($guru_id, $data);
        } else {
            // jika foto diganti
            $guru = $this->M_guru->where('guru_id', $guru_id)->first();
            if ($guru['guru_foto'] != "") {
                unlink('./foto_guru/' . $guru['guru_foto']);
            }
            $nama_file = $file->getRandomName();
            $data = [
                'guru_nip' => $this->request->getPost('guru_nip'),
                'guru_nama' => $this->request->getPost('guru_nama'),
                'guru_email' => $this->request->getPost('guru_email'),
                'guru_foto' => $nama_file,
            ];
            $file->move('foto_guru/', $nama_file);
            $this->M_guru->update($guru_id, $data);
        }
        return redirect()->to('guru')->with('warning', 'Data berhasil diedit');
    }
    //edit akun guru
    public function editAkunGuru($account_id)
    {
        $data_akun = [
            'account_username' => $this->request->getPost('account_username'),
            'account_password' =>  md5((string)$this->request->getPost('account_password')),
        ];
        $this->M_akun->update($account_id, $data_akun);
        return redirect()->to('guru')->with('warning', 'Data berhasil diedit');
    }
    //hapus data akun & guru
    public function deleteData($guru_id)
    {
        $guru = $this->M_guru->where('guru_id', $guru_id)->first();
        if ($guru['guru_foto'] != "") {
            unlink('./foto_guru/' . $guru['guru_foto']);
        }
        $this->M_guru->delete($guru_id);
        $this->M_akun->delete($guru['guru_account_id']);


        return redirect()->to(base_url('siswa'))->with('danger', 'Data berhasil dihapus');
    }
}
