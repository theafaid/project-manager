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
}
