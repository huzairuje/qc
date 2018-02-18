<?php

use Illuminate\Database\Seeder;

class AdminProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::filter('chunk')->load(public_path('csv/adminprovinsi.csv'))->chunk(250, function($results) {
          $header = [ 'id', 'user_id', 'provinsi_id', 'alamat', 'foto' ];
          foreach ($results->toArray() as $row) {
              $data = array_combine($header, $row);

              DB::table( 'admin_provinsi' )->insert($data);
          }
      });
    }
}
