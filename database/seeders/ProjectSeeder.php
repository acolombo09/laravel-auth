<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void {
        for ($i = 0; $i < 10; $i++) {
            $proj = new Project;

            $proj->title = $faker->word();
            $proj->description = $faker->sentence();
            $proj->image = $faker->imageUrl(480, 300, 'games', true);
            $proj->link = $faker->url();

            $proj->save();
        }
    }
}
