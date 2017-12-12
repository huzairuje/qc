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
               'email' => 'pusat@quickcount.com',
               'name' => 'Admin Pusat',
               'parent_id' => 0,
               'gender' => 'Male',
               'username' => 'pusat',
               'phone' => '+6281212345678',
               'role' => 'admin-pusat'
           ],
           [
               'email' => 'event@quickcount.com',
               'name' => 'Admin Event',
               'parent_id' => 1,
               'gender' => 'Male',
               'username' => 'event',
               'phone' => '+6281223456781',
               'role' => 'admin-event'
           ],
           [
               'email' => 'provinsi@quickcount.com',
               'name' => 'Admin Provinsi',
               'parent_id' => 3,
               'gender' => 'Male',
               'username' => 'provinsi',
               'phone' => '+6281234567812',
               'role' => 'admin-provinsi'
           ],
           [
               'email' => 'kota@quickcount.com',
               'name' => 'Admin Kota',
               'parent_id' => 4,
               'gender' => 'Male',
               'username' => 'kota',
               'phone' => '+6281245678123',
               'role' => 'admin-kota'
           ],
           [
               'email' => 'kecamatan@quickcount.com',
               'name' => 'Admin Kecamatan',
               'parent_id' => 5,
               'gender' => 'Male',
               'username' => 'kecamatan',
               'phone' => '+6281256781234',
               'role' => 'admin-kecamatan'
           ],
           [
               'email' => 'korsak@quickcount.com',
               'name' => 'Korsak',
               'parent_id' => 6,
               'gender' => 'Male',
               'username' => 'korsak',
               'phone' => '+6281267812345',
               'role' => 'korsak'
           ],
           [
               'email' => 'saksi@quickcount.com',
               'name' => 'Saksi',
               'parent_id' => 7,
               'gender' => 'Male',
               'username' => 'saksi',
               'phone' => '+6281278123456',
               'role' => 'saksi'
           ]
       ];

       foreach ( $datas as $key => $data )
       {
          $user = Sentinel::registerAndActivate([
            'email' => $data[ 'email' ],
            'username' => $data[ 'username' ],
            'phone' => $data[ 'phone' ],
            'parent_id' => $data[ 'parent_id' ],
            'password' => '12345678',
            'first_name' => $data[ 'name' ]]);
          Sentinel::findRoleBySlug( $data[ 'role' ] )->users()->attach( $user );
      }
      Schema::enableForeignKeyConstraints();
  }
}
