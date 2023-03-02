<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $project->technologies()->attach(Technology::inRandomOrder()->limit(rand(1, 5))->get());
        }
    }
}
