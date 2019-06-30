<?php

namespace App\Servicies\Projects;

class StoreTaskService
{
    public function handle($project, $data)
    {
        $project->tasks()->create($data);
    }
}
