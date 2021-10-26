<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->count(10)->hasStatuses(1)->create();
        Task::factory()->count(10)->create();
       // $this->call(TaskStatusSeeder::class, 20);
    }
}
