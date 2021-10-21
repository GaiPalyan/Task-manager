<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    protected Model $user;
    protected Model $status;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('statuses.index'));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function testStatusCreateWithoutLogIn()
    {
        $response = $this->get(route('statuses.create'));
        $response->assertRedirect(route('statuses.index'));
    }

    public function testStatusCreateWithLogIn()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice'));

        $response = $this->get(route('statuses.index'));
        $response->assertSeeText(__('Create Status'));
        $response = $this->get(route('statuses.create'));
        $response->assertSessionHasNoErrors();
        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $status = ['name' => 'New Status'];
        $response = $this->post(route('statuses.store'), $status);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $status);
    }

    public function testUpdate()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $newName = 'Updated';
        $existStatus = TaskStatus::findorFail($this->status->id);
        $response = $this->patch(route('statuses.update', $existStatus->id), ['name' => $newName]);
        $response->assertRedirect(route('statuses.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $newName]);

        $response = $this->get(route('statuses.index'));
        $response->assertSeeText('Статус обновлен');
    }
}


