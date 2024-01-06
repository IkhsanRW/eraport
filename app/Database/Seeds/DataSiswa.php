<?php

namespace App\Database\Seeds;

use App\Models\ModelAccount;
use App\Models\ModelSiswa;
use CodeIgniter\Database\Seeder;

class DataSiswa extends Seeder
{
    public function run()
    {
        $dataSiswa = [
            [
                'dataAccount' => [
                    'account_username' => '6921',
                    'account_password' => md5('0199237882'),
                    'account_role_id' => '3',
                ],
                'dataSiswa' => [
                    'siswa_nis' => '6921',
                    'siswa_nisn' => '0199237882',
                    'siswa_nama' => 'Gordon Prakoso',
                    'siswa_tempat_lahir' => 'Yogyakarta',
                    'siswa_tanggal_lahir' => '2001-11-04',
                    'siswa_jenis_kelamin' => 'Laki-Laki',
                    'siswa_agama' => 'Islam',
                    'siswa_status_dalam_keluarga' => 'Anak Kandung',
                    'siswa_anak_ke' => '1',
                    'siswa_alamat' => 'Yogyakarta',
                    'siswa_telepon' => '08355282528',
                    'siswa_sekolah_asal' => 'SMP N 2 Sleman',
                    'siswa_alamat_sekolah_asal' => 'Sleman',
                    'siswa_kelas_awal' => '1',
                    'siswa_kelas_sekarang' => '1',
                    'siswa_foto' => 'av_default.png',
                    'siswa_created_by' => '1',
                    'siswa_updated_by' => '1',
                ]
            ]
        ];
        $account = new ModelAccount();
        $siswa = new ModelSiswa();
        foreach ($dataSiswa as $dt) {
            $before = count($account->findAll());
            $account->insert($dt['dataAccount']);
            $after = count($account->findAll());
            if ($after > $before) {
                $dtAccount = $account->orderBy('account_id', 'desc')->first();
                $tmp = $dt['dataSiswa'];
                $tmp['siswa_account_id'] = $dtAccount['account_id'];
                $siswa->insert($tmp);
            }
        }
    }
}
