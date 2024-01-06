<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAccount;

class Auth extends BaseController
{
    private $modelAccount = null;

    function __construct()
    {
        $this->modelAccount = new ModelAccount();
    }

    public function index()
    {
        if (session('log_auth')) {
            return $this->redirectBack();
        }
        return view('login');
    }

    public function login()
    {
        if (session('log_auth')) {
            return $this->redirectBack();
        }
        if (!$this->validate([
            'txtUsername' => 'required|alpha_numeric_punct',
            'txtPassword' => 'required|alpha_numeric_punct'
        ])) {
            return redirect()->to(base_url('auth'))->with('danger', 'Username atau Password tidak sesuai');
        }

        $dtAccount = $this->modelAccount->where('account_username', $this->request->getPost('txtUsername'))
            ->where('account_password', md5((string)$this->request->getPost('txtPassword')))
            ->first();
        if (empty($dtAccount)) {
            return redirect()->to(base_url('auth'))->with('danger', 'Username atau Password salah.');
        }

        $data = $this->modelAccount->getAccount($dtAccount['account_id']);
        if (!$data['status']) {
            return redirect()->to(base_url('auth'))->with('danger', $data['msg']);
        }

        $sessionData = [
            'accountID' => $dtAccount['account_id'],
            'accountName' => $data['detailAccount'][$data['prefixDetail'] . '_nama'],
            'accountRole' => $dtAccount['account_role_id'],
            'accountRoleName' => $data['roleName']
        ];
        session()->set('log_auth', $sessionData);

        return redirect()->to(base_url());
    }

    public function logout()
    {
        session()->remove('log_auth');
        return redirect()->to(base_url('auth'));
    }
}
