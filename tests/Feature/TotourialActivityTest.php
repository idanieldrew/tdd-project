<?php

namespace Tests\Feature;

use App\Models\Totourial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TotourialActivityTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function create_activity_after_create_toturial()
    {
        $this->Login();

        $totourial = Totourial::factory()->create();

        $this->assertCount(1, $totourial->activities);

        $this->assertDatabaseHas('activities', ['title' => "create_without_task_$totourial->id"]);
    }

    /** @test */
    public function update_activity_after_update_totourial()
    {
        $this->Login();

        $totourial = Totourial::factory()->create();

        $title = $totourial->title;
        $totourial->update(['title' => 'updated']);

        $this->assertCount(2, $totourial->activities);

        $change = [
            'before' => ['title' => $title],
            'after' => ['title' => 'updated']
        ];

        $this->assertEquals($change, $totourial->activities->last()->changes);

        // $this->assertDatabaseHas('activities', ['title' => "updated_without_task_$totourial->id"]);
    }

    /** @test */
    public function create_activity_after_create_task()
    {
        $this->Login();

        $totourial = Totourial::factory()->create();

        $totourial->addTask(['body' => 'create']);

        $this->assertCount(1, $totourial->activities);

        $this->assertDatabaseHas('activities', ['title' => "create_without_task_$totourial->id"]);

        $this->assertDatabaseHas('activities', ['title' => "create_with_task"]);
    }

    /** @test */
    public function create_activity_after_complate_in_tasks_table()
    {
        $this->Login();

        $totourial = Totourial::factory()->create();

        $task = $totourial->addTask(['body' => 'create']);

        $attribute = [
            'complete' => true
        ];

        $this->patch(route('task.update', [$totourial->id, $task->id]), $attribute);

        $this->assertCount(1, $totourial->activities);

        $this->assertDatabaseHas('tasks', ['complete' => true]);
        $this->assertDatabaseHas('activities', ['title' => "create_without_task_$totourial->id"]);

        $this->assertDatabaseHas('activities', ['title' => 'create_with_complete_task']);
    }

    /** @test */
    public function create_activity_after_incomplate_in_tasks_table()
    {
        $this->Login();

        $totourial = Totourial::factory()->create();

        $task = $totourial->addTask(['body' => 'create']);

        $true = [
            'complete' => true
        ];

        $this->patch(route('task.update', [$totourial->id, $task->id]), $true);

        $false = [
            'complete' => false
        ];

        $this->patch(route('task.update', [$totourial->id, $task->id]), $false);

        $this->assertDatabaseHas('tasks', ['complete' => false]);

        $this->assertDatabaseHas('activities', ['title' => 'create_with_incomplete_task']);
    }
}
