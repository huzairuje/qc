<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Schema::disableForeignKeyConstraints();

    	DB::table('activations')->truncate();
    	DB::table('persistences')->truncate();
    	DB::table('reminders')->truncate();
    	DB::table('role_users')->truncate();
    	DB::table('throttle')->truncate();
    	DB::table('users')->truncate();

    	$datas = [
    		[
    			'email' => 'admin@paradise-store.com',
    			'name' => 'Super Administrator',
    			'gender' => 'Male',
    			'role' => 'super-admin'
    		],
    		[
    			'email' => 'Ark@paradise-store.com',
    			'name' => 'Ark Island',
    			'gender' => 'Male',
    			'role' => 'super-admin'
    		],
    		[
    			'email' => 'johndoe@paradise-store.com',
    			'name' => 'John Doe',
    			'gender' => 'Male',
    			'role' => 'admin'
    		]
    	];

    	foreach ( $datas as $key => $data ) {
    		$user = Sentinel::registerAndActivate( [
    			'email' => $data[ 'email' ],
    			'password' => '12345678',
    			'first_name' => $data[ 'name' ],
    		] );
    		Sentinel::findRoleBySlug( $data[ 'role' ] )->users()->attach( $user );
    	}

    	$faker = \Faker\Factory::create();
    	for ($i = 2; $i <= 5; $i++) {
    		$user = Sentinel::registerAndActivate( [
    			'email' => $faker->freeEmail,
    			'password' => '12345678',
    			'first_name' => $faker->firstName . ' ' . $faker->lastName,
    		] );

    		Sentinel::findRoleBySlug('admin')->users()->attach( $user );
    	}
    	Schema::enableForeignKeyConstraints();
    }
}
