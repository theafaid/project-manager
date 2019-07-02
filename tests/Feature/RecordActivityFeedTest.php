<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;

class RecordActivityFeedTest extends TestCase
{
    /** @test */
    function creating_a_project()
    {
        $project = create(Project::class);

        $this->assertCount(1, $activities = $project->activities);

        $this->assertEquals('created', $activities[0]->type);
    }

    /** @test */
    function updating_a_project()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);

        $this->withoutExceptionHandling();

        $this->patch(route('projects.update', $project->slug), make(Project::class)->toArray());

        $this->assertCount(2, $activities = $project->activities);

        $this->assertEquals('created', $activities[0]->type);
        $this->assertEquals('updated', $activities[1]->type);
    }

    /** @test */
    function creating_new_task()
    {
        $project = create(Project::class);

        $project->tasks()->create(make(Task::class)->toArray());

        $this->assertCount(2, $activities = $project->fresh()->activities);
        $this->assertEquals('created_task', $activities[1]->type);

    }

    /** @test */
    function completing_a_task()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);
        $task = $project->tasks()->create(make(Task::class)->toArray());

        $this->patch(route('projects.tasks.update', [$project->slug, $task->id]), [
            'body' => 'task',
            'completed' =>  true
        ]);

        $this->assertCount(3, $activities = $project->fresh()->activities);
        $this->assertEquals('completed_task', $activities[2]->type);
    }

    /** @test */
    function incompleting_a_task()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);
        $task = $project->tasks()->create(make(Task::class)->toArray());

        $this->withoutExceptionHandling();

        $this->patch(route('projects.tasks.update', [$project->slug, $task->id]), [
            'body' => 'task',
            'completed' =>  0
        ]);

        $this->assertCount(3, $activities = $project->fresh()->activities);
        $this->assertEquals('incompleted_task', $activities[2]->type);
    }
}
