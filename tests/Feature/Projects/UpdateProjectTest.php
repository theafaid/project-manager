<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use Tests\TestCase;

class UpdateProjectTest extends TestCase
{
   /** @test */
   function a_user_can_update_a_project()
   {
       $this->signIn();

       $this->withoutExceptionHandling();
       $project = create(Project::class, ['owner_id' => auth()->id()]);

       $newProject = make(Project::class);

       $this->patch(route('projects.update', $project->slug),
           $newProject->toArray()
       )->assertRedirect(route('projects.show', $newProject->slug));

       $this->assertDatabaseHas('projects', ['slug' => $newProject->slug]);
   }

   /** @test */
   function an_authenticated_user_cannot_update_project_of_others()
   {
       $this->signIn();

       $otherProject = create(Project::class);

       $this->patch(route('projects.update', $otherProject->slug), [])
           ->assertStatus(403);
   }
}
