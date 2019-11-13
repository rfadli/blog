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
        $faker = Factory::create();
        DB::table('users')->insert([
            [
                'name' => "Jhon Doe",
                'slug' => "jhon-doe",
                'email' => "jhondoe@test.com",
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'name' => "Rian Fadli",
                'slug' => "rian-fadli",
                'email' => "rian@test.com",
                'password' => bcrypt('rian666'),
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'name' => "elmaika",
                'slug' => "elmaika",
                'email' => "elmaika@test.com",
                'password' => bcrypt('elmaika123'),
                'bio' => $faker->text(rand(250, 300))
            ],
        ]);
    }
}
