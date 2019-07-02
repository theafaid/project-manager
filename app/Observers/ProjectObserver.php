<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $this->recordActivity($project, 'created');
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        $this->recordActivity($project, 'updated');
    }

    private function recordActivity($project, $type)
    {
        Activity::create(['project_id' => $project->id, 'type' => $type]);
    }
}
