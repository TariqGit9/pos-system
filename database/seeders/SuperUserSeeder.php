<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
            'name' => 'Super Admin'
        ]);

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'tariq@movrs.com',
            'password' => Hash::make(999999),
            'is_active' => 1,
            'is_super_admin' => true,
            'company_id' => null,
        ]);
        $user->assignRole($superAdmin);

        $user = User::create([
            'name' => 'Rizwan',
            'email' => 'rizwan@rose.com',
            'password' => Hash::make(12345678),
            'is_active' => 1,
            'is_super_admin' => true,
            'company_id' => null,
        ]);
        $user->assignRole($superAdmin);


    }
}
