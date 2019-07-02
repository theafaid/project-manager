<?php

namespace Tests\Unit\Models;

use Illuminate\Support\Collection;
use App\Models\Project;
use App\Models\User;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /** @test */
    function it_belongs_to_user()
    {
        $project = create(Project::class);

        $this->assertInstanceOf(User::class, $project->owner);
    }

    /** @test */
    function it_has_tasks()
    {
        $project = create(Project::class);

        $this->assertInstanceOf(Collection::class, $project->tasks);
    }

    /** @test */
    function it_has_activities()
    {
        $project = create(Project::class);

        $this->assertInstanceOf(Collection::class, $project->activities);
    }

    /** @test */
    function it_record_a_new_activity()
    {
        $project = create(Project::class);

        $project->recordActivity('create_activity');

        $this->assertCount(2, $project->activities);
        $this->assertEquals('create_activity', $project->activities[1]->type);
    }
}
