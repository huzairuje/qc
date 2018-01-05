<?php

use Illuminate\Database\Seeder;

class DummyWakilSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/wakil.csv'))->chunk(250, function($results) {
            $header = [ 'id','calon_id', 'nama' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'wakil' )->insert($data);
            }
        });
    }
}
