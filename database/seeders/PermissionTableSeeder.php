<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [ 
            'dashboard',
            'master-data',
            'departement-list',
            'departement-create',
            'departement-edit',
            'departement-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'profile',
            'profile-edit',
            'surat-masuk',
            'surat-masuk-action-detail',
            'surat-masuk-action-button',
            'surat-masuk-action-create',
            'surat-masuk-action-pengajuan',
            'surat-masuk-action-verifikasi',
            'surat-masuk-action-disposisi',
            'surat-disposisi',
            'surat-disposisi-action',
            'surat-keluar',
            'surat-keluar-action',
            'laporan-surat-masuk',
            'laporan-surat-keluar',
            'kop-surat',
            'assign-tugas',
            'assign-tugas-action',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
