<?php

namespace Tests\Feature;

use App\Models\Totourial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TotourialTasksTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_totourial_have_a_task()
    {
        $this->Login();

        $totourial = Totourial::factory()->create(['user_id' => auth()->user()->id]);

        $this->post(route('task.store', $totourial->id), ['body' => 'bucks']);

        $this->get(route('totourial.show', $totourial->id))->assertSee('bucks');
    }

    /** @test */
    public function a_task_can_update()
    {
        $this->Login();

        $totourial = Totourial::factory()->create(['user_id' => auth()->user()->id]);

        $task = $totourial->addTask(['body' => 'win']);
        $this->patch(route('task.update', [$totourial->id, $task->id]), []);

        $this->assertDatabaseHas('tasks',['body' => 'changed']);
    }

    /** @test */
    public function just_owner_can_create_task()
    {
        $this->Login();

        $totourial = Totourial::factory()->create();

        $this->post(route('task.store', $totourial->id), ['body' => 'bucks'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'bucks']);
    }

    /** @test */
    public function a_task_has_a_body()
    {
        $this->Login();

        $totourial = Totourial::factory()->create(['user_id' => auth()->user()->id]);

        $this->post(route('task.store', $totourial->id), ['body' => ''])->assertSessionHasErrors('body');
    }
}
