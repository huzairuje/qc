<?php

use Illuminate\Database\Seeder;

class KecamatansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // DB::table('kecamatan')->truncate();
        // Schema::enableForeignKeyConstraints();
        Excel::filter('chunk')->load(public_path('csv/districts.csv'))->chunk(250, function($results) {
            $header = [ 'id', 'kota_kabupaten_id', 'nama' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'kecamatan' )->insert($data);
            }
        });
    }
}
