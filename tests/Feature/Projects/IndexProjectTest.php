<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use Tests\TestCase;

class IndexProjectTest extends TestCase
{
    /** @test */
    function guests_cannot_see_index_projects_page()
    {
        $this->get(route('projects.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function user_can_see_index_projects()
    {
        $this->signIn();

        create(Project::class, ['owner_id' => auth()->id()], 2);

        $this->get(route('projects.index'))
            ->assertStatus(200)
            ->assertSee(auth()->user()->projects->random()->title)
            ->assertViewIs('projects.index');
    }

    /** @test */
    function user_cannot_see_others_projects()
    {
        $this->signIn();

        $projectByOtherUser = create(Project::class);

        $this->get(route('projects.index'))
            ->assertDontSee($projectByOtherUser->title);
    }
}
