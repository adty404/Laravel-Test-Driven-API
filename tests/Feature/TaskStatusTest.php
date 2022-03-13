<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_task_status_can_be_changed()
    {
        $task = $this->createTask();

        $response = $this->patchJson(route('task.update', $task->id), [
            'status' => Task::STARTED,
        ]);

        $this->assertDatabaseHas('tasks', [
            'status' => Task::STARTED,
        ]);

    }
}
