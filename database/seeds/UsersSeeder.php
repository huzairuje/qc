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
    			'email' => 'admin@quickcount.com',
    			'name' => 'Super Administrator',
                'gender' => 'Male',
                'username' => 'admin',
                'phone' => '+6281212345678',
    			'role' => 'admin-pusat'
    		],
    		[
    			'email' => 'Ark@paradise-store.com',
    			'name' => 'Ark Island',
    			'gender' => 'Male',
                'username' => 'ark',
                'phone' => '+6281223456781',
    			'role' => 'admin-kota'
    		],
    		[
    			'email' => 'johndoe@paradise-store.com',
    			'name' => 'John Doe',
    			'gender' => 'Male',
                'username' => 'john',
                'phone' => '+6281234567812',
    			'role' => 'admin-kecamatan'
    		]
    	];

    	foreach ( $datas as $key => $data ) {
    		$user = Sentinel::registerAndActivate( [
                'email' => $data[ 'email' ],
                'username' => $data[ 'username' ],
                'phone' => $data[ 'phone' ],
    			'password' => '12345678',
    			'first_name' => $data[ 'name' ],
    		] );
    		Sentinel::findRoleBySlug( $data[ 'role' ] )->users()->attach( $user );
    	}

    	$faker = \Faker\Factory::create();
    	for ($i = 0; $i < 3; $i++) {
    		$user = Sentinel::registerAndActivate( [
    			'email' => $faker->freeEmail,
                'username' => $data[ 'username' ],
                'phone' => $data[ 'phone' ],
    			'password' => '12345678',
    			'first_name' => $faker->firstName . ' ' . $faker->lastName,
    		] );

    		Sentinel::findRoleBySlug('admin')->users()->attach( $user );
    	}
    	Schema::enableForeignKeyConstraints();
    }
}
