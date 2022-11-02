<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisablesForeignKeys;
use Illuminate\Database\Seeder;


class AssignRoleUserTableSeeder extends Seeder
{
    use DisablesForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        $this->disableForeignKeys();

        User::find(1)->assignRole(config('access.role.admin_role'));
        User::find(2)->assignRole(config('access.role.admin_role'));

        $this->enableForeignKeys();
    }
}
