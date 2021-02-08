<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = User::create([
				'name'	=>	'Mang Kepweng',
				'email'	=>	'demo@demo.com',
				'usertype'	=>	'admin',
				'password'	=>	Hash::make('admindemo'),
                'provider' =>   NULL,
                'checker' =>   '1',
                'provider_id' =>    NULL,
				]);

    }
}
