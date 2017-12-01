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
            'kota_kabupaten',
            'provinsi'
        ];

        $this->command->info('Truncating existing tables');
        DB::statement('TRUNCATE TABLE ' . implode(',', $tables). ';');


        $this->call(ProvinsisTableSeeder::class);
        $this->call(KotaKabsTableSeeder::class);
        $this->call(KecamatansTableSeeder::class);
        $this->call(KelurahanTableSeeder::class);
        $this->call(KelurahanTableSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
