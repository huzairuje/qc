<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
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
            'calon',
            'dapil_lokasi',
            'wakil',
            'dapil',
            'event',
            'partai',
            'suara',
            'tps',
            'user_event'
        ];

        $this->command->info('Truncating existing tables');
        DB::statement('TRUNCATE TABLE ' . implode(',', $tables). ';');

        $this->call(DummyEventSeeder::class);
        $this->call(DummyUserEventSeeder::class);
        $this->call(DummyPartaiSeeder::class);
        $this->call(DummyDapilSeeder::class);
        $this->call(DummyCalonSeeder::class);
        $this->call(DummyWakilSeeder::class);
        $this->call(DummyDapilLokasiSeeder::class);
        $this->call(DummyTpsSeeder::class);
        $this->call(DummySuaraSeeder::class);
    }
}
