<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
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

        User::create([
            'uuid' =>  Uuid::uuid4()->toString(),
            'user_name' => Str::random(6),
            'first_name' => 'Administrator',
            'last_name' => 'admin1',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'active' => User::ACTIVE,
        ]);

        
        User::create([
            'uuid' =>  Uuid::uuid4()->toString(),
            'user_name' => Str::random(6),
            'first_name' => 'Administrator',
            'last_name' => 'QuocTV',
            'email' => 'vanquoc26520@gmail.com',
            'password' => Hash::make('12345678'),
            'active' => User::ACTIVE,
        ]);

        $this->enableForeignKeys();
    }
}
