<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        $technologies = [
            'html 5',
            'css 3',
            'js es6',
            'php 8',
            'vue 3',
            'react',
            'angular',
            'laravel 9',
            'spring',
            'django',
            'vite',
            'node js',
            'ruby',
            'c',
            'cpp',
            'c sharp',
            'java',
            'swift',
            'dart',
        ];
        
        foreach ($technologies as $techName) {
            $tech = new Technology();
            $tech->name = $techName;
            $tech->slug = Str::slug($techName);
            $tech->bg_color = $faker->hexColor();//unique
            $tech->save();
        }
    }
}
