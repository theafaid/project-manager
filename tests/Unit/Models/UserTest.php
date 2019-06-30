<?php

namespace Tests\Unit\Models;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    function a_user_has_projects()
    {
        $user = create(User::class);
        $projects = create(Project::class, ['owner_id' => $user->id], 2);

        $this->assertInstanceOf(Collection::class, $user->projects);
        $this->assertInstanceOf(Project::class, $projects->random());
    }
}
