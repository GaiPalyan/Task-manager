<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /* ----------- Tests actions as guest --------------- */

    public function test_index(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function test_create_as_guest(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(403);
    }

    public function test_store_as_guest(): void
    {
        $task = make(Task::class)->make()->toArray();
        $this->get(route('tasks.create'))
             ->assertStatus(403);
        $this->post(route('tasks.store', $task))
             ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $task);
    }

    public function test_update_as_guest(): void
    {
        $task = make(Task::class)->create();
        $this->get(route('tasks.edit', $task))
            ->assertStatus(403);
        $this->patch(route('tasks.update', $task), ['name' => 'new name'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['name' => 'new name']);
    }

    public function test_delete_as_guest(): void
    {
        $task = make(Task::class)->create();
        $this->delete(route('tasks.destroy', $task))
            ->assertStatus(403);
        $this->assertModelExists($task);
    }

/* ---------- test actions as user ------------------ */

    public function test_create_as_user(): void
    {
        $this->actingAs($this->user)
             ->get(route('tasks.create'))
             ->assertOk();
    }

    public function test_store_as_user()
    {
        $task = make(Task::class)->make([
                'status_id' => make(TaskStatus::class)->create()->getAttribute('id'),
                'created_by_id' => $this->user->id,
            ])->toArray();

        $this->actingAs($this->user)
             ->post(route('tasks.store', $task))
             ->assertSessionHasNoErrors()
             ->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $task);

    }

    public function test_update_as_user()
    {
        $newData = make(Task::class)->make([
            'status_id' => make(TaskStatus::class)->create()->getAttribute('id')
        ])->toArray();
        $task = make(Task::class)->create();

        $this->actingAs($this->user)->patch(route('tasks.update', $task), $newData)
             ->assertRedirect(route('tasks.index'))
             ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $newData);
        $this->actingAs($this->user)->get(route('tasks.index'))
             ->assertSeeText('Задача успешно изменена');
    }

   public function test_delete_user_task()
    {
        $task = make(Task::class)->create([
            'created_by_id' => $this->user->id
        ]);
        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
        $this->actingAs($this->user)
             ->assertAuthenticatedAs($this->user)
             ->delete(route('tasks.destroy', $task))
             ->assertRedirect();

        $this->assertDeleted($task);
    }

    public function test_delete_not_user_task()
    {
        $task = make(Task::class)->create();
        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
        $this->actingAs($this->user)
            ->assertAuthenticatedAs($this->user)
            ->delete(route('tasks.destroy', $task))
            ->assertStatus(403);

        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
    }
}
