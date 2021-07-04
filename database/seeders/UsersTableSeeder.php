<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $faker = Faker\Factory::create();
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => $faker->password,
            ]);
        }
    }
}
