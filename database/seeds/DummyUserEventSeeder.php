<?php

use Illuminate\Database\Seeder;

class DummyUserEventSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Excel::filter('chunk')->load(public_path('csv/user_event.csv'))->chunk(250, function($results) {
            $header = [ 'id','user_id', 'event_id' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'user_event' )->insert($data);
            }
        });
    }
}
