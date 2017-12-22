<?php

use Illuminate\Database\Seeder;

class KotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Excel::filter('chunk')->load(public_path('csv/kota.csv'))->chunk(250, function($results) {
          $header = [ 'id','provinsi_id' ,'nama', ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'kota' )->insert($data);
          }
      });
    }
}
