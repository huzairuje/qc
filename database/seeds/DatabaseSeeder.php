<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Unguarding models');
        // Model::unguard();

        $tables = [
            'kelurahan',
            'kecamatan',
            'kota',
            'provinsi',
            'roles',
            'users',
            'role_users'
        ];

        $this->command->info('Truncating existing tables');
        DB::statement('TRUNCATE TABLE ' . implode(',', $tables). ';');


        $this->call(ProvinsisTableSeeder::class);
        $this->call(KotaTableSeeder::class);
        $this->call(KecamatansTableSeeder::class);
        $this->call(KelurahanTableSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(TingkatsSeeder::class);
    }
}
