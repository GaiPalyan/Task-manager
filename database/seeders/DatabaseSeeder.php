<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        TaskStatus::factory()->count(4)
                            ->state(new Sequence(
                                ['name' => 'новый'],
                                ['name' => 'в работе'],
                                ['name' => 'на тестировании'],
                                ['name' => 'завершен'],
                            ))
                            ->create();

        Label::factory()->count(5)->create();

        $labels = Label::all();
        Task::factory()->count(5)->create()
            ->each(static function (Task $task) use ($labels) {
                $task->labels()->attach($labels->random(random_int(1,5)));
            });
       // $this->call(TaskStatusSeeder::class, 20);
    }
}
