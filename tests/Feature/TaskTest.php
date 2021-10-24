<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class TaskTest extends TestCase
{
    protected Model $user;
    protected Model $task;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function testTaskCreateWithoutLogIn()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect(route('tasks.index'));
    }

    public function testTaskCreateWithLogIn()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice'));

        $response = $this->get(route('tasks.index'));
        $response->assertSeeText(__('Create task'));
        $response = $this->get(route('tasks.create'));
        $response->assertSessionHasNoErrors();
        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $task = Task::factory()->create(
            [
                'name' => 'Test task',
                'description' => 'bla bla bla',
                'status_id' => TaskStatus::factory(),
                'created_by_id' => User::factory(),
                'assigned_to_id' => null
            ]
        )->toArray();

        $response = $this->post(route('tasks.store'), $task);
      //  $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $task);
    }

}
