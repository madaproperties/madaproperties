<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DealPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'deal-list',
            'deal-create',
            'deal-edit',
            'deal-delete'
        ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
