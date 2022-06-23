<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SourcesPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'source-list',
            'source-create',
            'source-edit',
            'source-delete'
        ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
