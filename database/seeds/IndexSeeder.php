<?php

use App\User;
use App\ReferralCode;
use App\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class IndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ini buat role spatie (Super Admin)
        $superAdmin = Role::create([
            'name' => 'Super Admin',
        ]);

        // ini buat role spatie (User)
        $user = Role::create([
            'name' => 'User',
        ]);

        // ini buat permission (see_product)
        $permission = Permission::create([
            'name' => 'see_product'
        ]);
        $user->givePermissionTo($permission);

        // buat seeder super admin
        $data   = [
            'name'      => 'super admin',
            'email'     => 'super@mail.com',
            'password'  => Hash::make('12345678')
        ];

        $user = User::create($data);

        $user->syncRoles('Super Admin');

        $code = ReferralCode::insertGetId([
            'created_at' => date('Y-m-d H:i:s'),
            'token' => '11111',
            'status' => 'Aktif',
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'ref_id' => $code,
            'address' => 'Indramayu',
            'phone' => '12345678',
            'image' => null,
            'gender' => 'Laki-laki',
            'card_id' => null,
            'status' => 'Terverifikasi',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // buat seeder pengguna
        $data   = [
            'name'      => 'User Pertama',
            'email'     => 'user@mail.com',
            'password'  => Hash::make('12345678')
        ];
        $user = User::create($data);
        $user->syncRoles('User');

        $code = ReferralCode::insertGetId([
            'token' => '12345',
            'status' => 'Aktif',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'ref_id' => $code,
            'address' => 'Indramayu',
            'phone' => '12345678',
            'image' => 'profil.png',
            'gender' => 'Laki-laki',
            'card_id' => 'idCard.png',
            'status' => 'Terverifikasi',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
