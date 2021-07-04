<?php

use App\SystemLogType;
use Illuminate\Database\Seeder;

class SystemLogTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['頻道管理', '使用者管理', '匯入匯出', '個人帳號'];

        foreach ($types as $type_name) {
            SystemLogType::create([
                'name' => $type_name
            ]);
        }
    }
}
