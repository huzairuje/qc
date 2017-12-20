<?php

use Illuminate\Database\Seeder;

class KecamatansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // DB::table('kecamatan')->truncate();

      Excel::filter('chunk')->load(public_path('csv/districts.csv'))->chunk(250, function($results) {
          $header = [ 'id','kota_id' ,'nama' ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'kecamatan' )->insert($data);
          }
      });
    }
}
