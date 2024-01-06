<?php

namespace App\Database\Seeds;

use App\Models\ModelAccount;
use App\Models\ModelGuru;
use CodeIgniter\Database\Seeder;

class DataGuru extends Seeder
{
    public function run()
    {
        $dataGuru = [
            [
                'dataAccount' => [
                    'account_username' => '0199237882',
                    'account_password' => md5('12345678'),
                    'account_role_id' => '2',
                ],
                'dataGuru' => [
                    'guru_nip' => '0199237882',
                    'guru_nama' => 'Jems Suradi',
                    'guru_email' => 'suradijems33@gmail.com',
                    'guru_foto' => 'av_default.png',
                ]
            ]
        ];
        $account = new ModelAccount();
        $guru = new ModelGuru();
        foreach ($dataGuru as $dt) {
            $before = count($account->findAll());
            $account->insert($dt['dataAccount']);
            $after = count($account->findAll());
            if ($after > $before) {
                $dtAccount = $account->orderBy('account_id', 'desc')->first();
                $tmp = $dt['dataGuru'];
                $tmp['guru_account_id'] = $dtAccount['account_id'];
                $guru->insert($tmp);
            }
        }
    }
}
