<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use Tests\TestCase;

class ViewProjectTest extends TestCase
{
    /** @test */
    function a_user_can_view_a_project()
    {
        $project = create(Project::class );

        $this->get(route('projects.show', $project->slug))
            ->assertStatus(200)
            ->assertViewIs('projects.show')
            ->assertSee($project->title);
    }
}
