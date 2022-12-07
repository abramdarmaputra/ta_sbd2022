<?php

namespace Database\Seeders;

use Illuminate\Database\player\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'player-list',
            'player-create',
            'player-edit',
            'player-delete',
            'country-list',
            'country-create',
            'country-edit',
            'country-delete',
            'club-list',
            'club-create',
            'club-edit',
            'club-delete'
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}