<?php

namespace App\Services\Tasks;

class StoreTaskService
{
    public function handle($project, $data)
    {
        $project->tasks()->create($data);
    }

    private function store()
    {

    }

    private function lastUpdated()
    {

    }
}
