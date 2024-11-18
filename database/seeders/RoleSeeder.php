<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'administrator',
                'guard_name' => 'web',
            ],
            [
                'name' => 'employee',
                'guard_name' => 'web',
            ]
        ];
        DB::table('roles')->insert($roles);
    }
}
