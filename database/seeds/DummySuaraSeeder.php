<?php

use Illuminate\Database\Seeder;

class DummySuaraSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/suara_event_2.csv'))->chunk(250, function($results) {
            $header = [ 'id','tps_id', 'calon_id', 'jumlah' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'suara' )->insert($data);
            }
        });
    }
}
