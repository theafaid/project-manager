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
}
