<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    /** @test */
    function guests_cannot_add_task_in_a_project()
    {
        $this->post(route(
            'projects.tasks.store',
            create(Project::class)->slug)
        )->assertRedirect(route('login'));
    }

    /** @test */
    function a_user_can_add_task_in_project()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);
        $task = make(Task::class);

        $this->post(route('projects.tasks.store', $project->slug), $task->toArray());

        $this->assertDatabaseHas('tasks', ['body' => $task->body]);

        $this->assertCount(1, $project->fresh()->tasks);

        $this->get(route('projects.show', $project->slug))
            ->assertSee($task->body);
    }

    /** @test */
    function a_user_cannot_add_task_in_other_projects()
    {
        $this->signIn();

        $projectByOther = create(Project::class);

        $this->post(route('projects.tasks.store', $projectByOther->slug), ['body' => 'test'])
            ->assertStatus(403);
    }

    /** @test */
    function a_user_can_update_a_task()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);
        $task = $project->tasks()->create(make(Task::class)->toArray());

        $this->patch(route('projects.tasks.update', [$project->slug, $task->id]), [
            'body' => 'new text body',
            'completed' => true
        ])->assertRedirect(route('projects.show', $project->slug));

        $this->assertTrue($task->fresh()->hasCompleted());
        $this->assertDatabaseHas('tasks', ['body' => 'new text body']);
    }

    /** @test */
    function storing_a_task_will_update_last_update_time_for_its_project()
    {
        $project = create(Project::class);

        $project->tasks()->save(make(Task::class));


        $this->assertEquals($project->tasks()->first()->created_at, $project->updated_at);
    }
}
