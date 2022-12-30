<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Question::factory(1000)->create()->each(function ($question) {
            $type = $question->getType();
            if ($type == 'checkbox'){
                (\App\Models\Answer::factory()->count(1)->withParams($question->id, 1)->create());
                (\App\Models\Answer::factory()->count(1)->withParams($question->id, 0)->create());
                (\App\Models\Answer::factory()->count(1)->withParams($question->id, 0)->create());
            } else if ($type == 'radio') {
                (\App\Models\Answer::factory()->count(1)->withParams($question->id, 0.5)->create());
                (\App\Models\Answer::factory()->count(1)->withParams($question->id, 0.5)->create());
                (\App\Models\Answer::factory()->count(1)->withParams($question->id, 0)->create());   
            } else {
                (\App\Models\Answer::factory(1)->count(1)->withParams($question->id, 1)->create());
            }
        });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
