<?php

namespace App\Services\Tasks;

class StoreTaskService
{
    public function handle($project, $data)
    {
        $project->tasks()->create($data);
    }
}
