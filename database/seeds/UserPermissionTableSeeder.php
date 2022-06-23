<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'cash-list',
            'cash-create',
            'cash-edit',
            'cash-delete'
        ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
