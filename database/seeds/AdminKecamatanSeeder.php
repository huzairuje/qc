<?php

use Illuminate\Database\Seeder;

class AdminKecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::filter('chunk')->load(public_path('csv/adminkecamatan.csv'))->chunk(250, function($results) {
          $header = [ 'id', 'user_id', 'kecamatan_id', 'alamat', 'foto' ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'admin_kecamatan' )->insert($data);
          }
      });
    }
}
