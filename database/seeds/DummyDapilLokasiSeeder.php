<?php

use Illuminate\Database\Seeder;

class DummyDapilLokasiSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/dapil_lokasi.csv'))->chunk(250, function($results) {
            $header = [ 'id','dapil_id', 'lokasi_id', 'created_at', 'updated_at' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'dapil_lokasi' )->insert($data);
            }
        });
    }
}
