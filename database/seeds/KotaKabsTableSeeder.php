<?php

use Illuminate\Database\Seeder;

class KotaKabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // DB::table('kelurahan')->truncate();
        // DB::table('kecamatan')->truncate();
        // DB::table('kota_kabupaten')->truncate();
        // Schema::enableForeignKeyConstraints();
        Excel::filter('chunk')->load(public_path('csv/regencies.csv'))->chunk(250, function($results) {
            $header = [ 'id', 'provinsi_id', 'nama' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'kota_kabupaten' )->insert($data);
            }
        });
    }
}
