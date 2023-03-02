<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projectsInDb = Project::all(['title'])->toArray();
        for ($i=0; $i<30; $i++) {
            $proj = new Project();
            do{
                $proj->title = $faker->unique()->realTextBetween(4, 20);
            }while(in_array(['title' => $proj->title], $projectsInDb));
            $proj->user_id = User::inRandomOrder()->first()->id;
            $proj->type_id = Type::inRandomOrder()->first()->id;
            $proj->slug = Str::slug($proj->title) . '';
            $proj->content = $faker->realTextBetween(30, 200);
            $proj->image = 'images/projects/placeholder.jpg';
            $proj->start_date = $faker->dateTimeBetween('1990-12-20');
            $proj->end_date = (rand(0,1)) ? $faker->dateTimeBetween($proj->start_date) : null;
            // dd($proj);
            $proj->save();
        }
    }
}
