<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
   /*  public function run()
    {
        // $this->call(UserSeeder::class);
    } */
	 
   public function run(): void
    {
       
        DB::table('users')->insert([
            'name' => 'Sravanthi',
            'email' => 'it.chsravanthi@gmail.com',
			'mobile' => '9666642328',
            'password' => Hash::make('u@siPort@l'),
            'role' => 'Admin',
            'status' => 'Active',
        ]);
		DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'tsuesi.it@gmail.com',
			'mobile' => '7702471313',
            'password' => Hash::make('Admin@24'),
            'role' => 'Admin',
            'status' => 'Active',
        ]);
	}
    }

