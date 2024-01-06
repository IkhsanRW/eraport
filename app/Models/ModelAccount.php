<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAccount extends Model
{
    protected $table            = 'tb_account';
    protected $primaryKey       = 'account_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'account_id', 'account_username', 'account_password', 'account_role_id', 'account_created_by', 'account_deleted_by'
    ];

    // Dates
    protected $useSoftDeletes   = true;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'account_created_at';
    protected $updatedField  = 'account_updated_at';
    protected $deletedField  = 'account_deleted_at';

    public $backupkey = "account";

    public function getAccount(string $accountID): array
    {
        $failData =
            [
                'status' => false,
                'msg' => null,
                'account' => null,
                'detailAccount' => null,
                'roleName' => null
            ];
        if (empty(trim($accountID)) || is_null(trim($accountID)) || trim($accountID) == "") {
            $failData['msg'] = "ID akun tidak boleh kosong";
            return $failData;
        }
        $dtAccount = $this->join('tb_role', 'account_role_id = role_id')->where($this->primaryKey, $accountID)->first();
        if (empty($dtAccount)) {
            $failData['msg'] = 'Data akun tidak ditemukan';
            return $failData;
        }
        if ($dtAccount['account_role_id'] == 1) {
            $admin = new ModelAdmin();
            $dtAdmin = $admin->where('admin_account_id', $accountID)->first();
            if (empty($dtAdmin)) {
                $failData['msg'] = 'Data akun tidak lengkap';
                return $failData;
            }
            $prefixDetail = "admin";
            $detailData = $dtAdmin;
        } elseif ($dtAccount['account_role_id'] == 2) {
            $guru = new ModelGuru();
            $dtGuru = $guru->where('guru_account_id', $accountID)->first();
            if (empty($dtGuru)) {
                $failData['msg'] = 'Data akun tidak lengkap';
                return $failData;
            }
            $prefixDetail = "guru";
            $detailData = $dtGuru;
        } elseif ($dtAccount['account_role_id'] == 3) {
            $siswa = new ModelSiswa();
            $dtSiswa = $siswa->where('siswa_account_id', $accountID)->first();
            if (empty($dtSiswa)) {
                $failData['msg'] = 'Data akun tidak lengkap';
                return $failData;
            }
            $prefixDetail = "siswa";
            $detailData = $dtSiswa;
        } else {
            $failData['msg'] = 'Role akun tidak valid';
            return $failData;
        }
        $successData = $failData;
        $successData['status'] = true;
        $successData['msg'] = 'Data akun valid dan berhasil di dapatkan';
        $successData['account'] = $dtAccount;
        $successData['detailAccount'] = $detailData;
        $successData['roleName'] = $dtAccount['role_name'];
        $successData['prefixDetail'] = $prefixDetail;
        return $successData;
    }

    private function checkRole(string $accountID, int $validRole, string $validRoleName): array
    {
        $dtAccount = $this->getAccount($accountID);
        if (!$dtAccount['status']) {
            return [
                'status' => false,
                'msg' => $dtAccount['msg']
            ];
        }
        if ($dtAccount['account']['account_role_id'] != $validRole) {
            return [
                'status' => false,
                'msg' => 'Anda bukan ' . $validRoleName
            ];
        }
        return [
            'status' => true,
            'msg' => 'Anda adalah ' . $validRoleName
        ];
    }

    public function isAdmin(string $accountID): array
    {
        return $this->checkRole($accountID, 1, 'admin');
    }

    public function isGuru(string $accountID): array
    {
        return $this->checkRole($accountID, 2, 'guru');
    }

    public function isSiswa(string $accountID): array
    {
        return $this->checkRole($accountID, 3, 'siswa');
    }
}
