<?php

namespace Database\Seeders;

use App\Models\Admin\AdminRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminRole::create(['name' => config('admin.super_admin_role_name')]);
    }
}
