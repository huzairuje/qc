<?php

use Illuminate\Database\Seeder;

class KelurahanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // DB::table('kelurahan')->truncate();

      Excel::filter('chunk')->load(public_path('csv/kelurahan.csv'))->chunk(250, function($results) {
          $header = [ 'id', 'kecamatan_id','nama' ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'kelurahan' )->insert($data);
          }
      });
    }
}
