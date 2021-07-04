<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 建立權限
        $permissions = [
            ['name' => 'Staff:Read', 'description' => '檢視工人資料'],
            ['name' => 'Staff:Write', 'description' => '管理工人資料'],
            ['name' => 'Group:Read', 'description' => '檢視組別資料'],
            ['name' => 'Group:Write', 'description' => '管理組別資料'],
            ['name' => 'Equipment:Read', 'description' => '檢視器材資料'],
            ['name' => 'Equipment:Write', 'description' => '管理器材資料'],
            ['name' => 'RaiseEquipment:Read', 'description' => '檢視募集物資資料'],
            ['name' => 'RaiseEquipment:Write', 'description' => '管理募集物資資料'],
            ['name' => 'EquipmentBarcode:Read', 'description' => '檢視器材條碼'],
            ['name' => 'EquipmentBarcode:Write', 'description' => '管理器材條碼'],
            ['name' => 'Loan:Read', 'description' => '檢視器材借還'],
            ['name' => 'Loan:Write', 'description' => '管理器材借還'],
            ['name' => 'Student:Write', 'description' => '管理學生驗票'],
            ['name' => 'TelegramMessage:Read', 'description' => '檢視 Telegram 訊息發送'],
            ['name' => 'TelegramMessage:Write', 'description' => '管理 Telegram 訊息發送'],
            ['name' => 'TelegramChannel:Read', 'description' => '檢視 Telegram 群組'],
            ['name' => 'TelegramChannel:Write', 'description' => '管理 Telegram 群組'],
            ['name' => 'User:Read', 'description' => '檢視使用者'],
            ['name' => 'User:Write', 'description' => '管理使用者'],
            ['name' => 'Barcode:Read', 'description' => '檢視所有 Barcode'],
            ['name' => 'ImportExport:Read', 'description' => '匯出資料'],
            ['name' => 'ImportExport:Write', 'description' => '匯入資料'],
            ['name' => 'Role:Read', 'description' => '檢視角色'],
            ['name' => 'Role:Write', 'description' => '管理角色'],
            ['name' => 'Speaker:Read', 'description' => '檢視 Speaker'],
            ['name' => 'Speaker:Write', 'description' => '管理 Speaker'],
            ['name' => 'Sponsor:Read', 'description' => '檢視 Sponsor'],
            ['name' => 'Sponsor:Write', 'description' => '管理 Sponsor'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'name' => $permission['name'],
            ], [
                'description' => $permission['description'],
            ]);
        }

        // 建立 Role
        Role::updateOrCreate(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        // 為預設的的使用者加上加上權限
        User::find(1)->assignRole('admin');
    }
}
