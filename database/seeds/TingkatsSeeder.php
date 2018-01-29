<?php

use Illuminate\Database\Seeder;

class TingkatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::filter('chunk')->load(public_path('csv/tingkat.csv'))->chunk(250, function($results) {
          $header = [ 'id', 'nama' ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'tingkat' )->insert($data);
          }
      });
    }
}
