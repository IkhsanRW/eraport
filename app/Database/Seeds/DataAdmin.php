<?php

namespace App\Database\Seeds;

use App\Models\ModelAccount;
use App\Models\ModelAdmin;
use CodeIgniter\Database\Seeder;

class DataAdmin extends Seeder
{
    public function run()
    {
        $dataAdmin = [
            [
                'dataAccount' => [
                    'account_username' => '019928182617',
                    'account_password' => md5('12345678'),
                    'account_role_id' => '1',
                ],
                'dataAdmin' => [
                    'admin_nama' => 'Wahid Waluyo',
                    'admin_email' => 'wahidwal@gmail.com',
                    'admin_nip' => '019928182617'
                ]
            ]
        ];
        $account = new ModelAccount();
        $admin = new ModelAdmin();
        foreach ($dataAdmin as $dt) {
            $before = count($account->findAll());
            $account->insert($dt['dataAccount']);
            $after = count($account->findAll());
            if ($after > $before) {
                $dtAccount = $account->orderBy('account_id', 'desc')->first();
                $tmp = $dt['dataAdmin'];
                $tmp['admin_account_id'] = $dtAccount['account_id'];
                $admin->insert($tmp);
            }
        }
    }
}
