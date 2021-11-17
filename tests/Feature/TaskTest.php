<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use WithFaker;

    /* ----------- Tests actions as guest --------------- */

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function testCreateAsGuest(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(403);
    }

    public function testStoreAsGuest(): void
    {
        $task = make(Task::class)->make()->toArray();
        $this->get(route('tasks.create'))
             ->assertStatus(403);
        $this->post(route('tasks.store', $task))
             ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $task);
    }

    public function testUpdateAsGuest(): void
    {
        $task = make(Task::class)->create();
        $this->get(route('tasks.edit', $task))
            ->assertStatus(403);
        $this->patch(route('tasks.update', $task), ['name' => 'new name'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['name' => 'new name']);
    }

    public function testDeleteAsGuest(): void
    {
        $task = make(Task::class)->create();
        $this->delete(route('tasks.destroy', $task))
            ->assertStatus(403);
        $this->assertDatabaseHas('tasks', ['id' => $task->only('id')]);
    }

/* ---------- test actions as user ------------------ */

    public function testCreateAsUser(): void
    {
        $this->actingAs($this->user)
             ->assertAuthenticated()
             ->get(route('tasks.create'))
             ->assertOk();
    }

    public function testStoreAsUser(): void
    {
        $status = make(TaskStatus::class)->create();
        $task = make(Task::class)->make([
                'status_id' => $status->id,
                'created_by_id' => $this->user->getAttribute('id'),
            ])->toArray();

        $this->actingAs($this->user)
             ->post(route('tasks.store', $task))
             ->assertRedirect(route('tasks.index'))
             ->assertSessionHasNoErrors()
             ->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $task);
    }

    public function testUpdateAsUser(): void
    {
        $status = make(TaskStatus::class)->create();
        $newData = [
            'name' => 'New name',
            'status_id' => $status->id
        ];

        $task = make(Task::class)->create();

        $result = $this->actingAs($this->user)
             ->patch(route('tasks.update', $task), $newData)
             ->assertRedirect(route('tasks.index'))
             ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $newData);
        $this->actingAs($this->user)->get(route('tasks.index'))
             ->assertSeeText('Задача успешно изменена');
    }

    public function testDeleteUserTask(): void
    {
        $task = make(Task::class)->create([
            'created_by_id' => $this->user->getAttribute('id')
        ]);
        $this->assertDatabaseHas('tasks', ['name' => $task->only('name')]);
        $this->actingAs($this->user)
             ->assertAuthenticated()
             ->delete(route('tasks.destroy', $task))
             ->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['name' => $task->only('name')]);
    }

    public function testDeleteNotUserTask(): void
    {
        $task = make(Task::class)->create();
        $this->assertDatabaseHas('tasks', ['name' => $task->only('name')]);
        $this->actingAs($this->user)
            ->assertAuthenticated()
            ->delete(route('tasks.destroy', $task))
            ->assertStatus(403);

        $this->assertDatabaseHas('tasks', ['name' => $task->only('name')]);
    }
}
