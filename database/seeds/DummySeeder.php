<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Unguarding models');
        // Model::unguard();

        $tables = [
            'calon',
            'dapil_lokasi',
            'wakil',
            'dapil',
            'event',
            'partai',
            'suara',
            'tingkat',
            'tps',
            'user_event'
        ];

        $this->command->info('Truncating existing tables');
        DB::statement('TRUNCATE TABLE ' . implode(',', $tables). ';');

        Excel::filter('chunk')->load(public_path('csv/event.csv'))->chunk(250, function($results) {
            $header = [ 'id','nama', 'jenis_id', 'tingkat_id', 'lokasi', 'tahun', 'expired', 'created_at', 'updated_at' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'event' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/user_event.csv'))->chunk(250, function($results) {
            $header = [ 'id','user_id', 'event_id' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'user_event' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/partai.csv'))->chunk(250, function($results) {
            $header = [ 'id', 'nomor', 'nama', 'foto' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'partai' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/dapil.csv'))->chunk(250, function($results) {
            $header = [ 'id','event_id', 'nama', 'created_at', 'updated_at' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'dapil' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/calon.csv'))->chunk(250, function($results) {
            $header = [ 'id','dapil_id', 'tipe', 'partai_id', 'nomor', 'nama', 'has_wakil' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'calon' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/wakil.csv'))->chunk(250, function($results) {
            $header = [ 'id','calon_id', 'nama' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'wakil' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/dapil_lokasi.csv'))->chunk(250, function($results) {
            $header = [ 'id','dapil_id', 'lokasi_id', 'created_at', 'updated_at' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'dapil_lokasi' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/suara_event_2.csv'))->chunk(250, function($results) {
            $header = [ 'id','tps_id', 'calon_id', 'jumlah' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'suara' )->insert($data);
            }
        });

        Excel::filter('chunk')->load(public_path('csv/tps.csv'))->chunk(250, function($results) {
            $header = [ 'id','kelurahan_id', 'nomor' ];
            foreach ($results->toArray() as $row) {
                $data = array_combine($header, $row);

                DB::table( 'tps' )->insert($data);
            }
        });
    }
}
