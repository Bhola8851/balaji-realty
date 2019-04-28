<?php

use Illuminate\Database\Seeder;

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
        // DB::table('users')->insert([
        //     'name' => 'college',
        //     'email' => 'college@gmail.com',
        //     'password' => bcrypt('123456')
        // ]);
        // factory(App\snacks\Customer::class,20)->create();
        factory(App\snacks\CustomerMaterial::class,100)->create();
    }
}
