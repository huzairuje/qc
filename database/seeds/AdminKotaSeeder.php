<?php

use Illuminate\Database\Seeder;

class AdminKotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::filter('chunk')->load(public_path('csv/adminkota.csv'))->chunk(250, function($results) {
          $header = [ 'id', 'user_id', 'kota_id', 'alamat', 'foto' ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'admin_kota' )->insert($data);
          }
      });
    }
}
