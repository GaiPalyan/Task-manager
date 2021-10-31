<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
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
        Label::factory()->count(5)->create();
        $labels = Label::all();
        Task::factory()->count(5)->create()
            ->each(static function (Task $task) use ($labels) {
                $task->labels()->attach($labels->random(random_int(1,5)));
            });
       // $this->call(TaskStatusSeeder::class, 20);
    }
}
