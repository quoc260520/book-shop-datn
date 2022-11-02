<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    use  DisablesForeignKeys; 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        Role::create(['name' => config('access.role.admin_role')]);
        Role::create(['name' => config('access.role.default_role')]);
        Role::create(['name' => config('access.role.staff_role')]);

        $this->enableForeignKeys();

    }
}
