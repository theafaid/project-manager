<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use Tests\TestCase;

class EditProjectTest extends TestCase
{
    /** @test */
    function un_authenticated_user_cannot_see_edit_project_page()
    {
        $project = create(Project::class);

        $this->get(route('projects.edit', $project->slug))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function an_authenticated_users_cannot_see_edit_product_page_of_others()
    {
        $this->signIn();

        $project = create(Project::class);

        $this->get(route('projects.edit', $project->slug))
            ->assertStatus(403);
    }

    /** @test */
    function a_user_can_see_edit_product_page()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);

        $this->get(route('projects.edit', $project->slug))
            ->assertStatus(200)
            ->assertViewIs('projects.edit');
    }
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
