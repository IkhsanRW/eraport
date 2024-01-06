<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAccount;
use App\Models\ModelGuru;

class Profil_guru extends BaseController
{

    private $M_guru = null;
    private $M_akun = null;
    public function __construct()
    {
        $this->M_guru    = new ModelGuru();
        $this->M_akun = new ModelAccount();
        helper('form');
    }
    public function index()
    {
        $id_akun = session('log_auth')['accountID'];
        $data = [
            'title' => 'Profil',
            'title_content' => 'Profil Siswa',
            'dt_guru'   => $this->M_guru->where('guru_account_id', $id_akun)->join('tb_account', 'guru_account_id = account_id')->first()
        ];
        return view('guru/profil/index', $data);
    }

    public function update($account_id)
    {
        $id_siswa = session('log_auth')['accountID'];
        $data_akun = [
            'account_username' => $this->request->getPost('account_username'),
            'account_password' =>  md5((string)$this->request->getPost('account_password')),
        ];
        $this->M_akun->update($account_id, $data_akun);
        return redirect()->to('profil_guru')->with('warning', 'Data berhasil diubah');;
    }
}
