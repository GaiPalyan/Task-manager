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
        $response = $this->get(route('task_statuses'));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function testStatusCreateWithoutLogIn()
    {
        $response = $this->get(route('status_create'));
        $response->assertRedirect(route('task_statuses'));
    }

    public function testStatusCreateWithLogIn()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice'));

        $response = $this->get('task_statuses');
        $response->assertSeeText(__('Create status'));
        $response = $this->get(route('status_create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $status = ['name' => 'New status'];
        $response = $this->post(route('status_store'), $status);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $status);
    }

    public function testUpdate()
    {
        $newName = 'Updated';
        $existStatus = TaskStatus::findorFail($this->status->id);
        $response = $this->post(route('status_update', $existStatus->id), ['name' => $newName]);
        //$this->assertDatabaseHas('task_statuses', ['name' => 'в работе']);
    }

}


