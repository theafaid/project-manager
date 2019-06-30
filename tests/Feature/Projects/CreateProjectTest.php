<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    /** @test **/
    function a_user_can_create_a_project()
    {
        $this->signIn();

        $project = make(Project::class);

        $this->post(route('projects.store'), $project->toArray())
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', $project->toArray());
    }

    /** @test */
    function project_requires_title_and_description_and_owner()
    {
        $this->signIn();

        $this->post(route('projects.store'), [])
            ->assertSessionHasErrors(['title', 'description', 'owner_id']);
    }
}
