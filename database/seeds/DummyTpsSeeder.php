<?php

use Illuminate\Database\Seeder;

class DummyTpsSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/tps.csv'))->chunk(250, function($results) {
            $header = [ 'id','kelurahan_id', 'nomor' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'tps' )->insert($data);
            }
        });
    }
}
