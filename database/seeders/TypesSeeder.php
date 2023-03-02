<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = ['front-end','back-end','full-stack'];
        for ($i=0; $i < 3; $i++) { 
            $type = new Type();
            $type->name = $data[$i];
            $type->save();
        }
    }
}
