<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'level' => 1,
                'name' => 'Super Administrator', // all 
            ],
            [
                'level' => 2,
                'name' => 'Administrator',  // all but can't delete users
            ],
            [
                'level' => 3,
                'name' => 'Moderator',  //all but edit others
            ],
            [
                'level' => 4,
                'name' => 'Editor', //just edit and show others
            ],
            [
                'level' => 5,
                'name' => 'User',
            ]
        ];

        foreach ($roles as $role) {
            $newRole = new Role();
            $newRole->level = $role['level'];
            $newRole->name =  $role['name'];
            $newRole->save();
        }
    }
}
