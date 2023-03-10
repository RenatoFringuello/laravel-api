<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $user->api_token = 'o02RvrLpVYNTTNVR0lgoAIEhwAlthYjE4nPMMU5q5BlDiatjS0NCJ9Hgi1zqZ4X4SH5mSJqKmyeIkKLPNE6KzbrgHz';
        
        $user->save();
        
        $usersInDb = User::all(['username', 'email', 'api_token'])->toArray();
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
            do{
                $user->api_token = Str::random(90);
            }while(in_array(['api_token' => $user->api_token], $usersInDb));
            $user->save();
        }
    }
}
