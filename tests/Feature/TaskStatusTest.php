<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /* ------ Tests actions as guest ------ */
    public function test_index()
    {
        $response = $this->get(route('statuses.index'));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function test_status_create_as_guest()
    {
        $response = $this->get(route('statuses.create'));
        $response->assertStatus(403);
    }

    public function test_store_as_guest()
    {
        $status = make(TaskStatus::class)->make()->toArray();
        $this->post(route('statuses.store', $status))
            ->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', $status);
    }

    public function test_update_as_guest()
    {
        $status = make(TaskStatus::class)->create();
        $this->get(route('statuses.edit', $status))
             ->assertStatus(403);
        $this->patch(route('statuses.update', $status), ['name' => 'new name'])
             ->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', ['name' => 'new name']);
    }

    public function test_delete_as_guest()
    {
        $status = make(TaskStatus::class)->create();
        $this->delete(route('statuses.destroy', $status))
             ->assertStatus(403);
        $this->assertDatabaseHas('task_statuses', $status->only('id'));
    }

    /* ------ Test actions as user ------- */

    public function test_store_as_user()
    {
        $status = ['name' => 'New Status'];
        $this->actingAs($this->user)
             ->post(route('statuses.store'), $status)
             ->assertSessionHasNoErrors()
             ->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $status);

        $this->get(route('statuses.index'))
            ->assertSeeText('Статус успешно создан');
    }

    public function test_update_as_user()
    {
        $newName = ['name' => 'Updated'];
        $status = make(TaskStatus::class)->create();
        $this->actingAs($this->user)
             ->patch(route('statuses.update', $status), $newName)
             ->assertRedirect(route('statuses.index'))
             ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', $newName);

        $this->get(route('statuses.index'))
             ->assertSeeText('Статус успешно обновлен');
    }

    public function test_delete_status_as_user()
    {
        $status = make(TaskStatus::class)->create();
        $this->actingAs($this->user)
             ->delete(route('statuses.update', $status))
             ->assertSessionHasNoErrors()
             ->assertRedirect(route('statuses.index'));

        $this->get(route('statuses.index'))
             ->assertSeeText('Статус успешно удалён');

        $this->assertDeleted($status);
    }

    public function test_delete_status_associated_with_the_task()
    {
        $status = TaskStatus::factory()
            ->has(Task::factory()->state(['name' => 'New task']), 'task')
            ->create();

        $this->actingAs($this->user);
        $this->delete(route('statuses.destroy', $status))
            ->assertRedirect();

        $this->get(route('statuses.index'))
            ->assertSeeText('Не удалось удалить статус');

        $this->assertDatabaseHas('task_statuses', $status->only('id'));
    }
}


