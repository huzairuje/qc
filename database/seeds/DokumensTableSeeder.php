<?php

use Illuminate\Database\Seeder;

class DokumensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokumen')->insert([

            [
                'tipe_dokumen' => 'C1',
            ],
            [
                'tipe_dokumen' => 'C2',
            ],
            [
                'tipe_dokumen' => 'C3',
            ],
            [
            	'tipe_dokumen' => 'C4',
            ]

        ]);
    }
}
