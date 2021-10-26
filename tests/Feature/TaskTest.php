<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Util\Exception;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function testEditPage()
    {
        $existTask = $this->make('task')->create();

        $response = $this->get(route('tasks.edit', $existTask));
        $response->assertOk();
        $response->assertSessionHasNoErrors();
        $response->assertSeeText("Update task");
    }

    public function testTaskCreateWithoutLogIn()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect(route('tasks.index'));
    }

    public function testTaskCreateWithLogIn()
    {
        $this->getLoggedUser();
        $this->assertAuthenticated();

        $response = $this->get(route('tasks.index'));
        $response->assertSeeText(__('Create task'));
        $response = $this->get(route('tasks.create'));
        $response->assertSessionHasNoErrors();
        $response->assertOk();
    }

    public function testStore()
    {
        $user = $this->getLoggedUser();
        $this->assertAuthenticated();

        $task = [
            'name' => $this->faker->title,
            'description' => $this->faker->text,
            'status_id' => $this->make('status')->getAttribute('id'),
            'created_by_id' => $user->id,
            'assigned_to_id' => null
        ];

        $response = $this->post(route('tasks.store'), $task);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => $task['name']]);
    }

    public function testUpdate()
    {
        $this->getLoggedUser();
        $this->assertAuthenticated();

        $newData = [
          'name' => 'New Name',
          'description' => $this->faker->text,
          'status_id' => $this->make('status')->getAttribute('id')
        ];
        $this->make('task')->create();

        $response = $this->patch(route('tasks.update', Task::first()), $newData);
        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $newData);
        $response = $this->get(route('tasks.index'));
        $response->assertSeeText('Задача успешно изменена');
    }

    /*public function testDelete()
    {
        $user = $this->getLoggedUser();
        $this->assertAuthenticated();

        $task = $this->make('task')->create([
            'name' => $this->faker->title,
            'description' => $this->faker->text,
            'status_id' => $this->make('status')->getAttribute('id'),
            'created_by_id' => $user->id,
            'assigned_to_id' => null
        ]);
        //dd($user->getAuthIdentifier() === $task->getAttribute('created_by_id'));

        $response = $this->delete(route('tasks.destroy', $task));
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['name' => $task->name]);

    }*/

    /**
     * @param $subject
     * @return \Illuminate\Database\Eloquent\Collection|Model
     */
    protected function make($subject)
    {
        return match (strtolower($subject)) {
            'user' => User::factory()->create(),
            'status' => TaskStatus::factory()->create(),
            'task' => Task::factory(),
            default => throw new Exception('Wrong subject'),
        };
    }

    protected function loginUser(Model $user): bool
    {
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        return $response->getStatusCode() === 302;
    }

    protected function getLoggedUser()
    {
        $user = $this->make('user');
        $this->loginUser($user);
        return $user;
    }

}
