<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use Tests\TestCase;

class ViewProjectTest extends TestCase
{
    /** @test */
    function guests_cannot_see_create_project_page()
    {
        $this->get(route('projects.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function authenticated_users_can_see_create_project_page()
    {
        $this->signIn();

        $this->get(route('projects.create'))
            ->assertStatus(200)
            ->assertViewIs('projects.create');
    }
    /** @test */
    function a_user_can_view_a_project()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);

        $this->get(route('projects.show', $project->slug))
            ->assertStatus(200)
            ->assertViewIs('projects.show')
            ->assertSee($project->title);
    }

    /** @test */
    function a_user_cannot_view_others_project()
    {
        $this->signIn();

        $projectByOther = create(Project::class);

        $this->get(route('projects.show', $projectByOther->slug))
            ->assertStatus(403);
    }
}
