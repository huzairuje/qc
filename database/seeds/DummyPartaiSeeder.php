<?php

use Illuminate\Database\Seeder;

class DummyPartaiSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/partai.csv'))->chunk(250, function($results) {
            $header = [ 'id', 'nomor', 'nama', 'foto' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'partai' )->insert($data);
            }
        });
    }
}
