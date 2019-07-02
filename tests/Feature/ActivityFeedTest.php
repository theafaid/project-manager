<?php

namespace Tests\Feature;

use App\Models\Project;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    /** @test */
    function creating_a_project_generates_activity()
    {
        $project = create(Project::class);

        $this->assertCount(1, $activities = $project->activities);

        $this->assertEquals('created', $activities[0]->type);
    }

    /** @test */
    function updating_a_project_generates_activity()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);

        $this->withoutExceptionHandling();

        $this->patch(route('projects.update', $project->slug), make(Project::class)->toArray());

        $this->assertCount(2, $activities = $project->activities);

        $this->assertEquals('created', $activities[0]->type);
        $this->assertEquals('updated', $activities[1]->type);
    }
}
