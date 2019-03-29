<?php

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            'name' => 'JAPANESE',
            'is_verified' => 1,
            'type' => Skill::PERSONAL,
        ]);

    }
}
