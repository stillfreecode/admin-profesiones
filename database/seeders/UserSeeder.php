<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Datos manualmente creados
        User::create([
            'name' => 'user1',
            'email' => 'user1@mail.com',
            'password' => bcrypt('123456'),
            'profession_id' => '1',
        ]);
        User::create([
            'name' => 'user2',
            'email' => 'use2@mail.com',
            'password' => bcrypt('123456'),
            'profession_id' => '2',
        ]);
        User::create([
            'name' => 'user3',
            'email' => 'user3@mail.com',
            'password' => bcrypt('123456'),
            'profession_id' => '3',
        ]);
        User::create([
            'name' => 'user4',
            'email' => 'user4@mail.com',
            'password' => bcrypt('123456'),
            'profession_id' => '4',
        ]);
*/

        User::factory()->create();
        User::factory()->create(['profession_id' => '4',]);
        User::factory()->create([
            'email' => 'user@mail.com',
            'password' => bcrypt('123456'),
            'profession_id' => '2',
            'is_admin' => true,
        ]);
    }
}
