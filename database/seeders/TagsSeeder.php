<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTags();
    }

    private function createTags()
    {
        $data = [
            ["tag_name" => "Personal"],
            ["tag_name" => "Work"],
            ["tag_name" => "Shopping"],
            ["tag_name" => "Errands"],
            ["tag_name" => "Fitness"],
            ["tag_name" => "Study"],
            ["tag_name" => "Meeting"],
            ["tag_name" => "Travel"],
            ["tag_name" => "Entertainment"],
            ["tag_name" => "Home Improvement"],
            ["tag_name" => "Personal Development"],
            ["tag_name" => "Finance"],
            ["tag_name" => "Health"],
            ["tag_name" => "Creative"],
            ["tag_name" => "Others"]
        ];
        DB::table("tags")->insert($data);
    }
}
