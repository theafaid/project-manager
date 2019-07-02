<?php

namespace Tests\Feature\Tasks;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    /** @test */
    function guests_cannot_add_task_in_a_project()
    {
        $project =create(Project::class);

        $task = $project->tasks()->create(make(Task::class)->toArray());

        $this->delete(route('projects.tasks.destroy',$task->id))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function authenticated_user_cannot_delete_other_tasks()
    {
        $this->signIn();
        $project =create(Project::class);

        $task = $project->tasks()->create(make(Task::class)->toArray());

        $this->delete(route('projects.tasks.destroy',$task->id))
            ->assertStatus(403);
    }
   /** @test */
   function it_can_be_deleted()
   {
       $this->signIn();

       $project = create(Project::class, ['owner_id' => auth()->id()]);

       $task = $project->tasks()->create(make(Task::class)->toArray());

       $this->delete(route('projects.tasks.destroy', $task->id));

       $this->assertEmpty($project->tasks);

       $this->assertDatabaseMissing('tasks', ['body' => $task->body]);
   }
}
