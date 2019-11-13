<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        //generate 3 users author
        DB::table('users')->insert([
            [
                'name' => "Jhon Doe",
                'slug' => "jhon-doe",
                'email' => "jhondoe@test.com",
                'password' => bcrypt('secret')
            ],
            [
                'name' => "Rian Fadli",
                'slug' => "rian-fadli",
                'email' => "rian@test.com",
                'password' => bcrypt('rian666')
            ],
            [
                'name' => "elmaika",
                'slug' => "elmaika",
                'email' => "elmaika@test.com",
                'password' => bcrypt('elmaika123')
            ],
        ]);
    }
}
