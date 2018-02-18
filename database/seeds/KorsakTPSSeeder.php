<?php

use Illuminate\Database\Seeder;

class KorsakTPSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::filter('chunk')->load(public_path('csv/korsaktps.csv'))->chunk(250, function($results) {
          $header = [ 'id', 'user_id', 'tps_id', 'kelurahan_id', 'alamat', 'foto' ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'korsak_tps' )->insert($data);
          }
      });
    }
}
