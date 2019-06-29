<?php

namespace App\Servicies\Projects;

use App\Models\Project;

class StoreProjectService
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function handle($data)
    {
        $this->project->create($this->handleData($data));
    }

    private function handleData($data)
    {
        return array_merge($data, [
            'slug' => \Str::slug($data['title'])
        ]);
    }
}
