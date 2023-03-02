<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //test user
        $user = new User();
        $user->username = 'renato';
        $user->name = 'Renato';
        $user->lastname = 'Fringuello';
        $user->email = 'g@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();

        $usersInDb = User::all(['username', 'email'])->toArray();
        // dd($usersInDb);
        for ($i=0; $i<10; $i++) {
            $user = new User();
            do{
                $user->username = $faker->unique()->userName();
            }while(in_array(['username' => $user->username], $usersInDb));
            $user->name = $faker->name();
            $user->lastname = $faker->lastName();
            do{
                $user->email = $faker->unique()->email();
            }while(in_array(['email' => $user->email], $usersInDb));
            $user->password = Hash::make('12345678');
            $user->save();
        }
    }
}
