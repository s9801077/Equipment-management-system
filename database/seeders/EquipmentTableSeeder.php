<?php

use App\Equipment;
use Illuminate\Database\Seeder;

class EquipmentTableSeeder extends Seeder
{
    public function run()
    {
        $equipment = Equipment::create([
            'name'       => 'machine',
            'source'     => '',
            'memo'       => '',
            'amount'     => 20,
            'hasBarcode' => '1',
            'prefix'     => 'EQ',
        ]);
        for ($i = 0; $i < 20; $i++) {
            $faker = Faker\Factory::create('zh_TW');
            Equipment::create([
                'name'       => $faker->company,
                'source'     => '',
                'memo'       => '',
                'amount'     => rand(1, 10),
                'hasBarcode' => '0',
            ]);
        }
        $equipment->setBarcode();
    }
}
