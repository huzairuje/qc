<?php

use Illuminate\Database\Seeder;

class DummyDapilSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/dapil.csv'))->chunk(250, function($results) {
            $header = [ 'id','event_id', 'nama', 'created_at', 'updated_at' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'dapil' )->insert($data);
            }
        });
    }
}
