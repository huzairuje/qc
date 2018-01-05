<?php

use Illuminate\Database\Seeder;

class DummyEventSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/event.csv'))->chunk(250, function($results) {
            $header = [ 'id','nama', 'jenis_id', 'tingkat_id', 'lokasi', 'tahun', 'expired', 'created_at', 'updated_at' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'event' )->insert($data);
            }
        });
    }
}
