<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /** @test */
    function it_belongs_to_a_project()
    {
        $task = create(Task::class);

        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test */
    function can_check_if_user_owns_It()
    {
        $project = create(Project::class);

        $project->tasks()->save($task = make(Task::class));

        $this->assertTrue($task->ownsBy($project->owner));

        $anotherUser = create(User::class);

        $this->assertFalse($task->ownsBy($anotherUser));
    }
}
