<?php

namespace App\Services\Projects;

class StoreTaskService
{
    public function handle($project, $data)
    {
        $project->tasks()->create($data);
    }
}
