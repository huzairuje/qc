<?php

use Illuminate\Database\Seeder;

class ProvinsisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::filter('chunk')->load(public_path('csv/data_provinsi.csv'))->chunk(250, function($results) {
            $header = [ 'id', 'nama_provinsi' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'provinsi' )->insert($data);
            }
        });
    }
}
