<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use Tests\TestCase;

class LabelTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex()
    {
        $this->get(route('labels.index'))
             ->assertSessionHasNoErrors()
             ->assertOk();
    }
    /* ------- Test actions as guest --------- */

    public function test_create_as_guest()
    {
        $response = $this->get(route('labels.create'));
        $response->assertStatus(403);
    }

    public function test_store_as_guest()
    {
        $status = make(Label::class)->make()->toArray();
        $this->post(route('statuses.store', $status))
            ->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', $status);
    }

    public function test_update_as_guest()
    {
        $label = make(Label::class)->create();
        $this->get(route('labels.edit', $label))
             ->assertStatus(403);
        $this->patch(route('labels.update', $label), ['name' => 'new name'])
             ->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', ['name' => 'new name']);
    }

    public function test_delete_as_guest()
    {
        $label = make(Label::class)->create();
        $this->delete(route('labels.destroy', $label))
             ->assertStatus(403);
        $this->assertDatabaseHas('labels', $label->only('id'));
    }

    /* ------ Test actions as user ------- */

    public function test_store_as_user()
    {
        $label = make(Label::class)->make()->toArray();
        $this->actingAs($this->user)
             ->post(route('labels.store'), $label)
             ->assertSessionHasNoErrors()
             ->assertRedirect();
        $this->assertDatabaseHas('labels', $label);

        $this->get(route('labels.index'))
            ->assertSeeText('Метка успешно создана');
    }

    public function test_update_as_user()
    {
        $newName = ['name' => 'Updated'];
        $label = make(Label::class)->create();
        $this->actingAs($this->user)
             ->patch(route('labels.update', $label), $newName)
             ->assertRedirect(route('labels.index'))
             ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', $newName);

        $this->get(route('labels.index'))
            ->assertSeeText('Метка успешно изменена');
    }

    public function test_delete_as_user()
    {
        $label = make(Label::class)->create();
        $this->actingAs($this->user)
             ->delete(route('labels.update', $label))
             ->assertSessionHasNoErrors()
             ->assertRedirect(route('labels.index'));

        $this->get(route('labels.index'))
             ->assertSeeText('Метка успешно удалена');

        $this->assertDeleted($label);
    }

    public function test_delete_label_attached_with_the_task()
    {
        $label = make(Label::class)
             ->hasAttached(Task::factory()->count(1))->create();

        $this->actingAs($this->user);
        $this->delete(route('labels.destroy', $label))
             ->assertRedirect();

        $this->get(route('labels.index'))
             ->assertSeeText('Не удалось удалить метку');

        $this->assertDatabaseHas('labels', $label->only('id'));
    }

}
