<?php

use Illuminate\Database\Seeder;

class DummyCalonSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/calon.csv'))->chunk(250, function($results) {
            $header = [ 'id','dapil_id', 'tipe', 'partai_id', 'nomor', 'nama', 'has_wakil' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'calon' )->insert($data);
            }
        });
    }
}
