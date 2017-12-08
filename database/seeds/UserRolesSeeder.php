<?php

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->truncate();
        DB::table('roles')->truncate();

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'admin-pusat',
            'name' => 'Admin Pusat',
            'permissions' => [
                'admin' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'admin-event',
            'name' => 'Admin Event',
            'permissions' => [
                'admin' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'admin-provinsi',
            'name' => 'Admin Provinsi',
            'permissions' => [
                'admin' => true
            ]
        ]);

        // kota/kabupaten
        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'admin-kota',
            'name' => 'Admin Kota',
            'permissions' => [
                'admin' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'admin-kecamatan',
            'name' => 'Admin Kecamatan',
            'permissions' => [
                'admin' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'korsak',
            'name' => 'Korsak',
            'permissions' => [
                'admin' => false
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'saksi',
            'name' => 'Saksi',
            'permissions' => [
                'admin' => false
            ]
        ]);
    }
}
