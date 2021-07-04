<?php

use App\Group;
use App\Staff;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => '場務組',
        ]);
        Group::create([
            'name' => '行政組',
        ]);
        Group::create([
            'name' => '議程組',
        ]);
        for ($i = 0; $i < 40; $i++) {
            $faker = Faker\Factory::create('zh_TW');
            Staff::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'duties' => $faker->jobTitle,
                'phone' => $faker->phoneNumber,
                'group_id' => rand(1, 3),
            ]);
        }
    }
}
